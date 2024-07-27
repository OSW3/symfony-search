<?php 
namespace OSW3\Search\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Search\DependencyInjection\Configuration;
use OSW3\Search\Twig\Runtime\EntityExtensionRuntime;

class EntityExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_entities", [EntityExtensionRuntime::class, 'getAll']),
        ];
    }
}
