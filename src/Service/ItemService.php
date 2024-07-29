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
        private EntityService $entityService,
        private ProviderService $providerService,
        private UrlGeneratorInterface $urlGenerator,
    ){
        $this->params = $this->providerService->getOptions();
    }

    /**
     * Initialize the context of the entity being iterated
     *
     * @param [type] $entity
     * @return static
     */
    public function setEntity($entity): static 
    {
        $this->entity = $entity;
        $this->class = get_class($entity);

        return $this;
    }

    /**
     * Returns the entity of the current context
     *
     * @return mixed
     */
    public function getEntity(): mixed 
    {
        return $this->entity;
    }

    /**
     * Returns the name of the entity class of the current context
     *
     * @return string
     */
    public function getClass(): string 
    {
        return $this->class;
    }

    /**
     * Returns the alias of the current entity
     *
     * @return string
     */
    public function getAlias(): string 
    {
        $options = $this->entityService->getOptions($this->class);

        return $options['alias'];
    }

    /**
     * Returns the template path of the current entity
     *
     * @return string
     */
    public function getTemplate(): string 
    {
        $options = $this->entityService->getOptions($this->class);

        return $options['template'];
    }

    /**
     * Returns the name of the route of the current entity
     *
     * @return string
     */
    public function getRoute(): string 
    {
        $options = $this->entityService->getOptions($this->class);

        return $options['route']['name'];
    }

    /**
     * Returns the list of parameter names needed to generate the url
     *
     * @return array
     */
    public function getRouteParams(): array 
    {
        $options = $this->entityService->getOptions($this->class);

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
        $options  = $this->entityService->getOptions($this->class);
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