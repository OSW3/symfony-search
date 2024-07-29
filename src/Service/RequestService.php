<?php 
namespace OSW3\Search\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestService 
{
    private Request $request;
    private array $params;

    public function __construct(
        private ProviderService $providerService,
        private RequestStack $requestStack,
    ){
        $this->request = $requestStack->getCurrentRequest();
        $this->params = $this->providerService->getOptions();
    }

    /**
     * Returns the name of the request route
     *
     * @return string
     */
    public function getRoute(): string
    {
        return $this->params['request']['route'];
    }

    /**
     * Returns the request method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->params['request']['method'];
    }

    /**
     * Returns the request parameter
     *
     * @return string
     */
    public function getParameter(): string
    {
        return $this->params['request']['parameter'];
    }

    /**
     * Returns the searched expression
     *
     * @return string|null
     */
    public function getExpression(): ?string
    {
        $parameter = $this->getParameter();
        $expression = $this->request->query->get($parameter);

        if ($expression !== null)
        {
            $expression = trim($expression);

            if (empty($expression))
            {
                $expression = null;
            }
        }

        return $expression;
    }
}