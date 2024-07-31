<?php 
namespace OSW3\Search\Twig\Runtime;

use OSW3\Search\Service\QueryService;
use OSW3\Search\Service\RequestService;
use Twig\Extension\RuntimeExtensionInterface;

class RequestExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private RequestService $requestService,
        private QueryService $queryService,
    ){}
    
    public function getMethod(): string 
    {
        return $this->requestService->getMethod();
    }
    
    public function getParameter(): string 
    {
        return $this->requestService->getParameter();
    }
    
    public function getExpression(): ?string 
    {
        return $this->requestService->getExpression();
    }

    public function getPreparationTime(): int 
    {
        return $this->queryService->getPreparationTime();
    }
    public function getExecutionTime(): int 
    {
        return $this->queryService->getExecutionTime();
    }
}