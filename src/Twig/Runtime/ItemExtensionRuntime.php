<?php 
namespace OSW3\Search\Twig\Runtime;

use OSW3\Search\Service\ItemService;
use Twig\Extension\RuntimeExtensionInterface;

class ItemExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private ItemService $itemService
    ){}

    public function setEntity($entity): void 
    {
        $this->itemService->setEntity($entity);
    }

    public function getClass(): string 
    {
        return $this->itemService->getClass();
    }

    public function getAlias(): string 
    {
        return $this->itemService->getAlias();
    }

    public function getUrl(): string 
    {
        return $this->itemService->getUrl();
    }

    public function getPath(): string 
    {
        return $this->itemService->getPath();
    }

    public function getTitle(): ?string 
    {
        return $this->itemService->getTitle();
    }

    public function getDescription(): ?string 
    {
        return $this->itemService->getDescription();
    }

    public function getIllustration(): ?string 
    {
        return $this->itemService->getIllustration();
    }

    public function getTemplate(): ?string 
    {
        return $this->itemService->getTemplate();
    }
}