<?php 
namespace OSW3\Search\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Search\DependencyInjection\Configuration;
use OSW3\Search\Twig\Runtime\FormExtensionRuntime;

class FormExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_form", [FormExtensionRuntime::class, 'render'], ['is_safe' => ['html']]),
            new TwigFunction(Configuration::NAME."_form_template", [FormExtensionRuntime::class, 'getTemplate']),
        ];
    }
}
