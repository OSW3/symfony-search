<?php 
namespace OSW3\Search\Twig\Runtime;

use Twig\Environment;
use OSW3\Search\Service\PaginationService;
use Twig\Extension\RuntimeExtensionInterface;

class PaginationExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private Environment $environment,
        private PaginationService $paginationService,
    ){}

    public function render()
    {
        return $this->environment->render("@Search/pagination/base.twig");
    }

    public function getPage(): int
    {
        return $this->paginationService->getPage();
    }

    public function getPages(): int
    {
        return $this->paginationService->getPages();
    }

    public function getLinks(): array
    {
        return $this->paginationService->getLinks();
    }

    public function getFirstLink(): ?string 
    {
        return $this->paginationService->getFirstLink();
    }

    public function getLastLink(): ?string 
    {
        return $this->paginationService->getLastLink();
    }

    public function getPrevLink(): ?string 
    {
        return $this->paginationService->getPrevLink();
    }

    public function getNextLink(): ?string 
    {
        return $this->paginationService->getNextLink();
    }

    public function getPerPage(): int
    {
        return $this->paginationService->getPerPage();
    }
}