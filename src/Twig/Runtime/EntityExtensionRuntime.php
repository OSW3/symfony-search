<?php 
namespace OSW3\Search\Twig\Runtime;

use OSW3\Search\Service\EntityService;
use Twig\Extension\RuntimeExtensionInterface;

class EntityExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private EntityService $entityService
    ){}

    /**
     * @see EntityService::getAll()
     * 
     * @return array
     */
    public function getAll(): array
    {
        return $this->entityService->getAll();
    }
}