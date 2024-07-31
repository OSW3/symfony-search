<?php 
namespace OSW3\Search\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Search\DependencyInjection\Configuration;
use OSW3\Search\Twig\Runtime\RequestExtensionRuntime;

class RequestExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_request_method", [RequestExtensionRuntime::class, 'getMethod']),
            new TwigFunction(Configuration::NAME."_request_parameter", [RequestExtensionRuntime::class, 'getParameter']),
            new TwigFunction(Configuration::NAME."_request_expression", [RequestExtensionRuntime::class, 'getExpression']),
            new TwigFunction(Configuration::NAME."_request_preparation_time", [RequestExtensionRuntime::class, 'getPreparationTime']),
            new TwigFunction(Configuration::NAME."_request_execution_time", [RequestExtensionRuntime::class, 'getExecutionTime']),
        ];
    }
}
