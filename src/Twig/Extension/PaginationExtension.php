<?php 
namespace OSW3\Search\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Search\DependencyInjection\Configuration;
use OSW3\Search\Twig\Runtime\PaginationExtensionRuntime;

class PaginationExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_pagination", [PaginationExtensionRuntime::class, 'render'], ['is_safe' => ['html']]),
            new TwigFunction(Configuration::NAME."_pagination_page", [PaginationExtensionRuntime::class, 'getPage']),
            new TwigFunction(Configuration::NAME."_pagination_pages", [PaginationExtensionRuntime::class, 'getPages']),
            new TwigFunction(Configuration::NAME."_pagination_links", [PaginationExtensionRuntime::class, 'getLinks']),
            new TwigFunction(Configuration::NAME."_pagination_first_link", [PaginationExtensionRuntime::class, 'getFirstLink']),
            new TwigFunction(Configuration::NAME."_pagination_last_link", [PaginationExtensionRuntime::class, 'getLastLink']),
            new TwigFunction(Configuration::NAME."_pagination_prev_link", [PaginationExtensionRuntime::class, 'getPrevLink']),
            new TwigFunction(Configuration::NAME."_pagination_next_link", [PaginationExtensionRuntime::class, 'getNextLink']),
            new TwigFunction(Configuration::NAME."_pagination_per_page", [PaginationExtensionRuntime::class, 'getPerPage']),
        ];
    }
}
