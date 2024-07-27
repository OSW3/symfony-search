<?php 
namespace OSW3\Search\Components\Search;

use OSW3\Search\Service\ItemService;
use OSW3\Search\Service\ProviderService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@Search/results/item.twig')]
final class Item 
{
    #[ExposeInTemplate(name: 'entity')]
    public object $entity;

    #[ExposeInTemplate(name: 'class', getter: 'fetchClass')]
    private string $class = "";

    #[ExposeInTemplate(name: 'id', getter: 'fetchId')]
    private int|string $id = "";

    #[ExposeInTemplate(name: 'alias', getter: 'fetchAlias')]
    private int|string $alias = "";

    #[ExposeInTemplate(name: 'title', getter: 'fetchTitle')]
    private int|string $title = "";

    #[ExposeInTemplate(name: 'description', getter: 'fetchDescription')]
    private int|string $description = "";

    #[ExposeInTemplate(name: 'illustration', getter: 'fetchIllustration')]
    private int|string $illustration = "";

    #[ExposeInTemplate(name: 'provider', getter: 'fetchProvider')]
    private string $provider = "";

    #[ExposeInTemplate(name: 'template', getter: 'fetchTemplate')]
    private string $template = "";

    #[ExposeInTemplate(name: 'route', getter: 'fetchRoute')]
    private string $route = "";

    #[ExposeInTemplate(name: 'route_parameters', getter: 'fetchRouteParameters')]
    private array $routeParameters = [];

    #[ExposeInTemplate(name: 'url', getter: 'fetchUrl')]
    private string $url = "";

    #[ExposeInTemplate(name: 'path', getter: 'fetchPath')]
    private string $path = "";

    public function __construct(
        private ProviderService $providerService,
        private ItemService $itemService,
        private UrlGeneratorInterface $urlGenerator
    ){
        // $this->itemService->setEntity($this->entity);
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        // Custom Placeholder
        $resolver->setRequired('entity');
        $resolver->setAllowedTypes('entity', ['object']);

        return $resolver->resolve($data) + $data;
    }

    public function fetchEntity()
    {
        return $this->entity;
    }

    public function fetchId(): int|string
    {
        return $this->entity->getId();
    }

    public function fetchAlias(): string
    {
        return $this->itemService->getAlias();
    }

    public function fetchClass(): string
    {
        return $this->itemService->getClass();
    }

    public function fetchTitle(): ?string
    {
        return $this->itemService->getTitle();
    }

    public function fetchDescription(): ?string
    {
        return $this->itemService->getDescription();
    }

    public function fetchIllustration(): ?string
    {
        return $this->itemService->getIllustration();
    }

    public function fetchProvider(): string
    {
        return $this->providerService->guessProvider();
    }

    public function fetchTemplate(): string
    {
        return $this->itemService->getTemplate();
    }

    public function fetchRoute(): string
    {
        return $this->itemService->getRoute();
    }

    public function fetchRouteParameters(): array
    {
        return $this->itemService->getRouteParams();
    }

    public function fetchUrl(): string
    {
        return $this->itemService->getUrl();
    }

    public function fetchPath(): string
    {
        return $this->itemService->getPath();
    }
}