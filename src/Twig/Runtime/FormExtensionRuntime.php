<?php 
namespace OSW3\Search\Twig\Runtime;

use Twig\Environment;
use OSW3\Search\Service\FormService;
use Twig\Extension\RuntimeExtensionInterface;

class FormExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private Environment $environment,
        private FormService $formService,
    ){}

    public function render(array $options=[]): string 
    {
        return $this->environment->render("@Search/form/base.twig", array_merge([
            'id' => null,
            'class' => null,
            'placeholder' => null,
            'label' => null,
        ], $options, [
            'template' => $this->getTemplate()
        ]));
    }
    
    /**
     * @see FormService::getTemplate()
     *
     * @return string
     */
    public function getTemplate(): string 
    {
        return $this->formService->getTemplate();
    }
}