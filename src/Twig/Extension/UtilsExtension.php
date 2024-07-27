<?php 
namespace OSW3\Search\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Search\Twig\Runtime\UtilsExtensionRuntime;
use Twig\TwigFilter;

class UtilsExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('highlight', [UtilsExtensionRuntime::class, 'highlight'], ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('_add_attribute', [UtilsExtensionRuntime::class, 'addAttribute']),
            new TwigFunction('_get_attributes', [UtilsExtensionRuntime::class, 'getAttributes'], ['is_safe' => ['html']]),

            new TwigFunction('highlight', [UtilsExtensionRuntime::class, 'highlight'], ['is_safe' => ['html']]),
            new TwigFunction('highlight_stat', [UtilsExtensionRuntime::class, 'highlightStat']),
        ];
    }
}
