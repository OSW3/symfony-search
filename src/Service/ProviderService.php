<?php 
namespace OSW3\Search\Service;

use Symfony\Component\HttpFoundation\Request;
use OSW3\Search\DependencyInjection\Configuration;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProviderService 
{
    private string $current;
    private array $params;
    private Request $request;

    public function __construct(
        #[Autowire(service: 'service_container')] private ContainerInterface $container,
        private RequestStack $requestStack,
    ){
        $this->params  = $container->getParameter(Configuration::NAME);
        $this->request = $this->requestStack->getCurrentRequest();

        if (empty($this->params)) {
            throw new \Exception("There is no provider defined in the confg/packageges/search.yaml");
        }

        // Set the default provider
        $all = $this->getAll();
        $this->setCurrent( reset($all) );
    }

    /**
     * Return all providers names
     *
     * @return array
     */
    public function getAll(): array 
    {
        return array_keys($this->params);
    }

    public function setCurrent(string $name): static 
    {
        $all = $this->getAll();

        if (!in_array($name, $all))
        {
            throw new \Exception(sprintf("The provider \"%s\" is not defined. Available provider are \"%s\"", $name, implode("\", \"", $all)));
        }

        $this->current = $name;

        return $this;
    }

    public function getCurrent(): string 
    {
        return $this->current;
    }

    /**
     * Return options for a specific provider
     *
     * @param string|null $provider
     * @return array
     */
    public function getOptions(?string $provider=null): array 
    {
        if ($provider === null) {
            $provider = $this->guessProvider();
        }

        if ($provider === null) {
            $provider = $this->current;
        }

        return $this->params[$provider];
    }

    /**
     * Return the name of the current provider base on the request parameter
     *
     * @return string|null
     */
    public function guessProvider(): ?string
    {
        if ($this->request->get('_route') !== "search") {
            return null;
        }

        // Get the query parameters
        $queryParams = $this->request->query->all();
        $queryParams = array_keys($queryParams);

        // Get providers of the config
        $providers = $this->getAll();

        foreach ($providers as $provider)
        {
            $options = $this->params[$provider];

            if (in_array($options['request']['parameter'], $queryParams)) {
                return $provider;
            }
        }

        return null;
    }
}