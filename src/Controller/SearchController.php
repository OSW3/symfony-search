<?php 
namespace OSW3\Search\Controller;

use OSW3\Search\Service\QueryService;
use OSW3\Search\Service\EntityService;
use OSW3\Search\Service\PaginationService;
use Symfony\Component\Filesystem\Path;
use OSW3\Search\Service\ProviderService;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    public function __construct(
        private KernelInterface $kernel,
        private ProviderService $providerService,
        private QueryService $queryService,
        private EntityService $entityService,

        private PaginationService $paginationService
    ){}

    #[Route('', name: 'search', methods: ['GET','POST'])]
    public function fetch(): Response
    {
        if (!$provider = $this->providerService->guessProvider())
        {
            throw $this->createNotFoundException('invalid search parameter name.');
            return new Response("",404);
        }



        /// Template
        /// --

        // Get template
        $template = $this->getTemplate($provider);

        // Create template if don't exist
        // It makes a copy of the bundle template file that you can customize later
        $this->createTemplate($template);



        // Exclude some entities
        $this->entityService->exclude("App\Entity\Product");


        /// Fetch
        /// --
        $results = $this->queryService->fetch();




        /// Rendering
        /// --

        return $this->render($template, [
            'results' => $results,
        ]);
    }

    private function createTemplate(string $template): void
    {
        $projectDir = $this->kernel->getProjectDir();
        $source     = Path::join(__DIR__ . "/../../", "templates/results/base.html");
        $target     = Path::join($projectDir, "templates", $template);

        if (preg_match("/^@Search/", $template) || file_exists($target)) {
            return;
        }
        
        (new Filesystem)->copy($source, $target, false);
    }

    private function getTemplate(string $provider): ?string 
    {
        $options = $this->providerService->getOptions($provider);
        return $options['results']['template'];
    }
}