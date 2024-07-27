<?php 
namespace OSW3\Search\Service;

use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ItemService 
{
    private array $params;
    private mixed $entity = null;
    private string $class;

    public function __construct(
        private ProviderService $providerService,
        private UrlGeneratorInterface $urlGenerator,
    ){
        $this->params = $this->providerService->getOptions();
    }

    public function setEntity($entity): static 
    {
        $this->entity = $entity;
        $this->class = get_class($entity);

        return $this;
    }

    public function getEntity(): mixed 
    {
        return $this->entity;
    }

    public function getClass(): string 
    {
        return $this->class;
    }

    public function getAlias(): string 
    {
        $options = $this->getOptions();

        return $options['alias'];
    }

    public function getTemplate(): string 
    {
        $options = $this->getOptions();

        return $options['template'];
    }

    /**
     * Return options for an entity
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->params['entities'][$this->class];
    }

    /**
     * Return the name of the route of the entity found
     *
     * @return string
     */
    public function getRoute(): string 
    {
        $options = $this->getOptions();

        return $options['route']['name'];
    }
    public function getRouteParams(): array 
    {
        $options = $this->getOptions();

        return $options['route']['parameters'];
    }

    public function getUrl(bool $absolute=true): string 
    {
        $route  = $this->getRoute();
        $params = $this->getRouteParams();
        $class   = $absolute ? UrlGenerator::ABSOLUTE_URL : UrlGenerator::ABSOLUTE_PATH;

        foreach ($this->getRouteParams() as $name)
        {
            $getter        = "get".ucfirst($name);
            $params[$name] = $this->entity->$getter();
        }

        return $this->urlGenerator->generate($route, $params, $class);

        return "xxx";
    }

    public function getPath(): string 
    {
        return $this->getUrl(false);
    }

    public function getTitle(): ?string 
    {
        return $this->getProperty('title');
    }
    
    public function getDescription(): ?string 
    {
        return $this->getProperty('description');
    }
    
    public function getIllustration(): ?string 
    {
        return $this->getProperty('illustration');
    }

    private function getProperty(string $propertyName): ?string
    {
        $options  = $this->getOptions();
        $class    = $this->getClass();
        $entity   = $this->getEntity();
        $property = $options[$propertyName];

        if ($property === null) 
        {
            $property = $propertyName;
        }

        if ($property === false) 
        {
            return null;
        }

        if (!property_exists($class, $property))
        {
            throw new \Exception("Unknown property {$property} for the entity {$class}. Verify the option search.{$this->providerService->getCurrent()}.entities.{$class}.{$propertyName}: {$property} in your config file (config/packages/search.yaml)");
        }

        $getter = "get".ucfirst($property);

        return $entity->$getter();
    }
}