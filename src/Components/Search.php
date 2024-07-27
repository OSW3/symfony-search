<?php 
namespace OSW3\Search\Components;

use OSW3\Search\Service\FormService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@Search/form/base.twig')]
final class Search 
{
    #[ExposeInTemplate(name: 'template', getter: 'fetchTemplate')]
    private ?string $template;

    #[ExposeInTemplate(name: 'id')]
    public string $id;

    #[ExposeInTemplate(name: 'class')]
    public string $class;

    #[ExposeInTemplate(name: 'placeholder')]
    public ?string $placeholder;

    #[ExposeInTemplate(name: 'label')]
    public ?string $label;

    public function __construct(
        private FormService $formService
    ){}

    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        // Custom ID
        $resolver->setDefaults(['id' => ""]);
        $resolver->setAllowedTypes('id', ['string']);

        // Custom Class
        $resolver->setDefaults(['class' => ""]);
        $resolver->setAllowedTypes('class', ['string']);

        // Custom Placeholder
        $resolver->setDefaults(['placeholder' => null]);
        $resolver->setAllowedTypes('placeholder', ['null','string']);

        // Custom Label
        $resolver->setDefaults(['label' => null]);
        $resolver->setAllowedTypes('label', ['null','string']);

        return $resolver->resolve($data) + $data;
    }

    public function fetchTemplate(): ?string
    {
        return $this->formService->getTemplate();
    }
}