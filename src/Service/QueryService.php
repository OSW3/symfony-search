<?php 
namespace OSW3\Search\Service;

use OSW3\Search\Enum\RequestOperators;
use OSW3\Search\Service\EntityService;
use OSW3\Search\Service\RequestService;
use Doctrine\ORM\EntityManagerInterface;
use OSW3\Search\Service\ProviderService;
use OSW3\Search\Service\PaginationService;

class QueryService 
{
    private array $queries        = [];
    private array $results        = [];
    private int $total            = 0;
    private int $preparation_time = 0;
    private int $execution_time   = 0;
    private int $total_time       = 0;

    private array $timers = [];

    public function __construct(
        private EntityManagerInterface $entityManager,
        private EntityService $entityService,
        private RequestService $requestService,
        private ProviderService $providerService,
        private PaginationService $paginationService,
    ){}

    /**
     * Prepare , execute and return the results of the query
     *
     * @param array $groups
     * @return array
     */
    public function fetch(string|array $groups=[]): array
    {
        return $this->prepare()->execute()->getResults($groups);
    }
    
    /**
     * Prepare the SQL request
     *
     * @return static
     */
    public function prepare(): static
    {
        // $tse_start = microtime(true);
        $this->setTime('prepare');

        $queries = [];

        // Searched expression
        // --

        if (!$expression = $this->requestService->getExpression()) {
            return $this;
        }


        // Entities lookup
        // --

        // Init the table alias serial (table_a as t0, table_2 as t1)
        $nTableSerial = 0;

        foreach ($this->entityService->queryable() as $entity)
        {
            $options     = $this->entityService->getOptions($entity);
            $conditions  = "";
            $tableAlias  = "t{$nTableSerial}";
            $entityAlias = $options['alias'];
            $criteria    = $options['criteria'];
            
            foreach ($criteria as $columnName => $columnOption)
            {
                $conditions.= !empty($conditions) ? " OR " : "";
                $conditions.= "{$tableAlias}.{$columnName} ";
                $conditions.= match($columnOption['match']) {
                    RequestOperators::LIKE->value           => "LIKE '%{$expression}%'",
                    RequestOperators::LEFT_LIKE->value      => "LIKE '%$expression'",
                    RequestOperators::RIGHT_LIKE->value     => "LIKE '$expression%'",
                    RequestOperators::NOT_LIKE->value       => "NOT LIKE '%$expression%'",
                    RequestOperators::NOT_LEFT_LIKE->value  => "NOT LIKE '%$expression'",
                    RequestOperators::NOT_RIGHT_LIKE->value => "NOT LIKE '$expression%'",
                    RequestOperators::IS_NOT->value         => "!= '$expression'",
                    RequestOperators::EQUAL->value          => "= '$expression'",
                    default                                 => "= '$expression'",
                };

                if (!empty($conditions))
                {
                    $queries[$entityAlias] = "SELECT {$tableAlias} FROM {$entity} as {$tableAlias} WHERE {$conditions}";
                }
            }
        }

        $this->queries = $queries;

        // $tse_end = microtime(true);
        // $this->preparation_time = $tse_end - $tse_start;
        $this->setTime('prepare');

        return $this;
    }
    
    /**
     * Execute the SQL requests
     *
     * @return static
     */
    public function execute(): static
    {
        // $tse_start = microtime(true);
        $this->setTime('execute');


        // Searched expression
        // --

        if (!$this->requestService->getExpression()) {
            return $this;
        }

        // Execute SQL Queries
        // --

        foreach ($this->queries as $entity => $sql)
        {
            $query   = $this->entityManager->createQuery($sql);
            $results = $query->getResult();

            $this->results[ $entity ] = $results;
        }

        // $tse_end = microtime(true);
        // $this->execution_time = $tse_end - $tse_start;
        $this->setTime('execute');

        return $this;
    }
    
    /**
     * Return the results of the search query
     *
     * @param array $groups
     * @return array
     */
    public function getResults(string|array $groups=[]): array
    {
        // Total results
        // --

        $this->total = array_sum(array_map("count", $this->results));


        // Reduce all separated entity results in one array
        // --

        $results = array_reduce($this->results, 'array_merge', []) ;


        // Apply a sorter
        // --

        // TODO: customize the sorter
        // TODO: Customize the order direction
        $sortBy = "title"; // null, id, title
        $direction = SORT_ASC; // SORT_DESC;
        
        $results = match($sortBy) {
            'id'    => $this->sortById($results, $direction),
            'title' => $this->sortByTitle($results, $direction),
            default => $results
        };


        // Apply pagination
        // --

        $results = $this->paginationService->paginate($results);
        
        // dump($this->preparation_time);
        // dump($this->execution_time);
        // dump($this->timers);



        // if (!is_array($groups))
        // {
        //     $groups = [$groups];
        // }

        // if (empty($groups))
        // {
            // foreach ( $this->results as $data )
            // {
            //     $results = array_merge($results, $data);
            // }
            // $this->total = count($results);
        // }
        // else foreach ($groups as $group)
        // {
        //     foreach ( $this->results as $alias => $data )
        //     {
        //         if ($group === $alias)
        //         {
        //             $results[$group] = $data;
        //             $this->total+= count($data);
        //         }
        //     }
        // }

        return $results;
    }
    
    /**
     * Return the number of results
     *
     * @return integer
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Sorter by ID
     *
     * @param array $array
     * @param [type] $direction
     * @return array
     */
    private function sortByID(array $array, int $direction=SORT_ASC): array 
    {
        $ids = [];
        $validItems = [];

        foreach ($array as $item) 
        {
            if (method_exists($item, 'getId')) 
            {
                $ids[] = $item->getId();
                $validItems[] = $item;
            }
        }

        array_multisort($ids, $direction, $validItems);

        return $validItems;
    }

    /**
     * Sorter by title
     *
     * @param array $array
     * @param [type] $direction
     * @return array
     */
    private function sortByTitle(array $array, int $direction=SORT_ASC): array 
    {
        $options = $this->providerService->getOptions();
        $titles = [];
        $validItems = [];

        foreach ($array as $item) 
        {
            $class = get_class($item);
            $property = $options['entities'][$class]['title'];

            if (property_exists($class, $property)) 
            {
                $getter = "get" . ucfirst($property);

                if (method_exists($item, $getter)) 
                {
                    $titles[] = $item->$getter();
                    $validItems[] = $item;
                }
            }
        }

        array_multisort($titles, $direction, $validItems);

        return $validItems;
    }

    private function setTime(string $id, ?int $now=null)
    {
        if ($now === null) {
            $now = microtime(true);
        }

        if (!isset($this->timers[$id])){
            $this->timers[$id] = ['s' => null, 'e' => null, 't' => 0];
        }

        if ($this->timers[$id]['s'] === null) {
            $this->timers[$id]['s'] = $now;
        }
        else if ($this->timers[$id]['e'] === null) {
            $this->timers[$id]['e'] = $now;
        }

        if ($this->timers[$id]['s'] !== null && $this->timers[$id]['e'] !== null) {
            $t = $this->timers[$id]['e'] - $this->timers[$id]['s'];
            $this->timers[$id]['t'] = floatval($t) * 1000;
        }
    }

    public function getPreparationTime(): int 
    {
        return $this->timers['prepare']['t'];
    }
    public function getExecutionTime(): int 
    {
        return $this->timers['execute']['t'];
    }
}