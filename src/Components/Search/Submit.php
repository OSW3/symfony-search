<?php 
namespace OSW3\Search\Components\Search;

use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@Search/form/submit.twig')]
final class Submit 
{
    #[ExposeInTemplate(name: 'label', getter: 'fetchLabel')]
    public ?string $label;

    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        // Custom Label
        $resolver->setDefaults(['label' => null]);
        $resolver->setAllowedTypes('label', ['null','string']);

        return $resolver->resolve($data) + $data;
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