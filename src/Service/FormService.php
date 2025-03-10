<?php 
namespace OSW3\Search\Service;

use OSW3\Search\Service\ProviderService;

class FormService 
{
    private array $params;

    public function __construct(
        private ProviderService $providerService,
    ){
        $this->params = $this->providerService->getOptions();
    }

    /**
     * Returns the path of the form template
     *
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->params['form']['template'];
    }
}