<?php 
namespace OSW3\Search\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Search\DependencyInjection\Configuration;
use OSW3\Search\Twig\Runtime\ItemExtensionRuntime;

class ItemExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_set_item", [ItemExtensionRuntime::class, 'setEntity']),
            new TwigFunction(Configuration::NAME."_item_url", [ItemExtensionRuntime::class, 'getUrl']),
            new TwigFunction(Configuration::NAME."_item_path", [ItemExtensionRuntime::class, 'getPath']),
            new TwigFunction(Configuration::NAME."_item_class", [ItemExtensionRuntime::class, 'getClass']),
            new TwigFunction(Configuration::NAME."_item_alias", [ItemExtensionRuntime::class, 'getAlias']),
            new TwigFunction(Configuration::NAME."_item_title", [ItemExtensionRuntime::class, 'getTitle']),
            new TwigFunction(Configuration::NAME."_item_description", [ItemExtensionRuntime::class, 'getDescription']),
            new TwigFunction(Configuration::NAME."_item_illustration", [ItemExtensionRuntime::class, 'getIllustration']),
            new TwigFunction(Configuration::NAME."_item_template", [ItemExtensionRuntime::class, 'getTemplate']),
        ];
    }
}
