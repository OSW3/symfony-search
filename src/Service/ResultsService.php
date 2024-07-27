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
     * Return the template of the result page
     *
     * @return string
     */
    public function getTemplate(): string 
    {
        return $this->params['results']['template'];
    }

    /**
     * Retuen the name of the route of the entity found
     *
     * @return string
     */
    public function getRoute(): string 
    {
        return $this->params['request']['route'];
    }

    /**
     * Return the URL of the found entity
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
     * Return the Path of the found entity
     *
     * @return string
     */
    public function getPath(): string 
    {
        return $this->getUrl(false);
    }
}