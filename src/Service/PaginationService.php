<?php 
namespace OSW3\Search\Service;

use OSW3\Search\Service\ProviderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaginationService 
{
    const int FIRST_PAGE = 1;

    private Request $request;
    private int $page;
    private int $pages = self::FIRST_PAGE;
    private int $perPage;
    private string $pageParam;
    private string $requestParam;
    private ?string $expression;

    public function __construct(
        private ProviderService $providerService,
        private RequestStack $requestStack,
        private UrlGeneratorInterface $urlGenerator,
    ){
        $options            = $this->providerService->getOptions();
        $this->perPage      = $options['results']['pagination']['per_page'];
        $this->pageParam    = $options['results']['pagination']['parameter'];
        $this->requestParam = $options['request']['parameter'];
        $this->request      = $requestStack->getCurrentRequest();
        $this->page         = $this->request->get($this->pageParam) ?? self::FIRST_PAGE;
        $this->expression   = $this->request->get($this->requestParam);
    }

    /**
     * Return the current page number
     *
     * @return integer
     */
    public function getPage(): int 
    {
        $page = $this->page;

        $page = $page < self::FIRST_PAGE ? self::FIRST_PAGE : $page;
        $page = $page > $this->pages ? $this->pages : $page;
        
        return $page;
    }

    /**
     * Return the number of total pages
     *
     * @return integer
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * Return pagination links
     *
     * @param string|null $id
     * @return null|string|array
     */
    public function getLinks(?string $id=null): null|string|array
    {
        $links = [];
        $current = $this->getPage();

        for ($i = 0; $i < $this->pages; $i++)
        {
            $page = $i+1;
            $url  = $this->urlGenerator->generate('search', [
                $this->requestParam => $this->expression,
                $this->pageParam    => $page
            ], UrlGenerator::ABSOLUTE_URL);

            $link = [
                'current' => $page === $current,
                'url' => $url,
            ];

            $links[] = $link;
        }

        if (empty($links)) {
            return $id === null ? [] : null;
        }

        return match($id) {
            'first' => call_user_func(function() use ($links) {
                $link = $links[0];
                return $link['url'];
            }),
            'last'  => call_user_func(function() use ($links) {
                $link = end($links);
                return $link['url'];
            }),
            'prev'  => call_user_func(function() use ($links, $current) {
                $index = $current - 1;
                $index = $index <= 1 ? 0 : $index - 1;
                $link = $links[$index];
                return $link['url'];
            }),
            'next'  => call_user_func(function() use ($links, $current) {
                $index = $current + 1;
                $index = $index >= $this->pages ? $this->pages : $index;
                $index = $index - 1;
                $link = $links[$index];
                return $link['url'];
            }),
            default => $links,
        };
    }

    public function getFirstLink(): ?string
    {
        return $this->getLinks('first');
    }

    public function getLastLink(): ?string
    {
        return $this->getLinks('last');
    }

    public function getPrevLink(): ?string
    {
        return $this->getLinks('prev');
    }

    public function getNextLink(): ?string
    {
        return $this->getLinks('next');
    }

    /**
     * Return the PerPage value
     *
     * @return integer
     */
    public function getPerPage(): int 
    {
        return $this->perPage;
    }

    /**
     * Return an array of fragment of data 
     * Execute the pagination
     *
     * @param array $array
     * @return array
     */
    public function paginate(array $array): array
    {
        if ($this->perPage <= 0) return $array;

        $perPage = $this->perPage;
        $total   = count($array);
        $pages   = (int) ceil($total / $perPage);
        $page    = $this->getPage();
        $page    = $page > $pages ? $pages : $page;
        $offset = ($perPage * $page) - $perPage;

        $this->pages = $pages;

        return array_slice($array, $offset, $perPage, true);
    }
}