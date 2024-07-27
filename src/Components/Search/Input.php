<?php 
namespace OSW3\Search\Components\Search;

use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@Search/form/input.twig')]
final class Input 
{
    #[ExposeInTemplate(name: 'placeholder', getter: 'fetchPlaceholder')]
    public ?string $placeholder;

    #[ExposeInTemplate(name: 'label', getter: 'fetchLabel')]
    public ?string $label;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        $resolver->setDefaults(['placeholder' => null]);
        $resolver->setAllowedTypes('placeholder', ['null','string']);

        $resolver->setDefaults(['label' => null]);
        $resolver->setAllowedTypes('label', ['null','string']);

        return $resolver->resolve($data) + $data;
    }

    public function fetchPlaceholder(): string
    {
        $placeholder = $this->placeholder;

        if (empty($placeholder)) {
            $placeholder = "Search for something";
        }

        return $placeholder;
    }

    public function fetchLabel(): string
    {
        $label = $this->label;

        if (empty($label)) {
            $label = "search";
        }

        return $label;
    }
}