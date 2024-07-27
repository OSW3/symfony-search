<?php 
namespace OSW3\Search\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Search\DependencyInjection\Configuration;
use OSW3\Search\Twig\Runtime\ResultsExtensionRuntime;

class ResultsExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_results", [ResultsExtensionRuntime::class, 'getResults']),
            new TwigFunction(Configuration::NAME."_results_url", [ResultsExtensionRuntime::class, 'getUrl']),
            new TwigFunction(Configuration::NAME."_results_path", [ResultsExtensionRuntime::class, 'getPath']),
            new TwigFunction(Configuration::NAME."_results_total", [ResultsExtensionRuntime::class, 'getTotal']),
            new TwigFunction(Configuration::NAME."_results_route", [ResultsExtensionRuntime::class, 'getRoute']),
            new TwigFunction(Configuration::NAME."_results_template", [ResultsExtensionRuntime::class, 'getTemplate']),
        ];
    }
}
