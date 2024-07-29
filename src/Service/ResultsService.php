<?php 
namespace OSW3\Search\Service;

use OSW3\Search\Service\ProviderService;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ResultsService 
{
    private array $params;

    public function __construct(
        private ProviderService $providerService,
        private UrlGeneratorInterface $urlGeneratorInterface,
    ){
        $this->params = $this->providerService->getOptions();
    }

    /**
     * Returns the path of the results page template.
     *
     * @return string
     */
    public function getTemplate(): string 
    {
        return $this->params['results']['template'];
    }

    /**
     * Returns the name of the results page route.
     *
     * @return string
     */
    public function getRoute(): string 
    {
        return $this->params['request']['route'];
    }

    /**
     * Returns the absolute or relative URL of the results page route.
     *
     * @return string
     */
    public function getUrl(bool $absolute=true): string 
    {
        $type = $absolute ? UrlGeneratorInterface::ABSOLUTE_URL : UrlGeneratorInterface::ABSOLUTE_PATH;

        return $this->urlGeneratorInterface->generate(
            name         : $this->getRoute(),
            referenceType: $type
        );
    }

    /**
     * Returns the relative Path of the results page route.
     *
     * @return string
     */
    public function getPath(): string 
    {
        return $this->getUrl(false);
    }
}