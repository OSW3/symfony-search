<?php 
namespace OSW3\Search\Twig\Runtime;

use OSW3\Search\Service\ProviderService;
use Twig\Extension\RuntimeExtensionInterface;

class ProviderExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private ProviderService $providerService
    ){}

    public function getAll(): array 
    {
        return $this->providerService->getAll();
    }

    public function getCurrentProvider(): string
    {
        return $this->providerService->getCurrent();
    }

    public function changeProvider(string $name): void
    {
        $this->providerService->setCurrent($name);
    }

    public function getOptions(): array 
    {
        return $this->providerService->getOptions();
    }
}