<?php 
namespace OSW3\Search\Service;

use OSW3\Search\Service\ProviderService;

class EntityService 
{
    private array $params;
    private array $excludes = [];

    public function __construct(
        private ProviderService $providerService
    ){
        $this->params = $this->providerService->getOptions();
    }

    /**
     * Returns the list of names of the entities on which the search applies
     *
     * @return array
     */
    public function getAll(): array 
    {
        return array_keys($this->params['entities']);
    }

    /**
     * Adding entities to the exclusion list
     *
     * @param string $entity
     * @return static
     */
    public function exclude(string $entity): static 
    {
        array_push($this->excludes, $entity);

        return $this;
    }

    /**
     * Return the list of queryable entities.
     * This is the list of entities on which the search query will apply
     *
     * @return array
     */
    public function queryable(): array 
    {
        return array_diff($this->getAll(), $this->excludes);
    }

    /**
     * Returns the configuration of a specific entity
     *
     * @param string $entity
     * @return array
     */
    public function getOptions(string $entity): array 
    {
        return $this->params['entities'][$entity];
    }
}