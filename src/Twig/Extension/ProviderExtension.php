<?php 
namespace OSW3\Search\Twig\Extension;

use OSW3\Search\DependencyInjection\Configuration;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Search\Twig\Runtime\ProviderExtensionRuntime;

class ProviderExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_providers", [ProviderExtensionRuntime::class, 'getAll']),
            new TwigFunction(Configuration::NAME."_current_provider", [ProviderExtensionRuntime::class, 'getCurrentProvider']),
            new TwigFunction(Configuration::NAME."_use_provider", [ProviderExtensionRuntime::class, 'changeProvider']),
            new TwigFunction(Configuration::NAME."_provider_options", [ProviderExtensionRuntime::class, 'getOptions']),
        ];
    }
}
