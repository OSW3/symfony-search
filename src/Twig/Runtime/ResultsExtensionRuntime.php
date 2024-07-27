<?php 
namespace OSW3\Search\Twig\Runtime;

use OSW3\Search\Service\QueryService;
use OSW3\Search\Service\ResultsService;
use Twig\Extension\RuntimeExtensionInterface;

class ResultsExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private ResultsService $resultsService,
        private QueryService $queryService,
    ){}

    public function getTemplate(): string 
    {
        return $this->resultsService->getTemplate();
    }

    public function getRoute(): string 
    {
        return $this->resultsService->getRoute();
    }
    
    public function getUrl(): string 
    {
        return $this->resultsService->getUrl();
    }
    
    public function getPath(): string 
    {
        return $this->resultsService->getPath();
    }

    public function getResults(): array 
    {
        return $this->queryService->getResults();
    }

    public function getTotal(): int 
    {
        return $this->queryService->getTotal();
    }
}