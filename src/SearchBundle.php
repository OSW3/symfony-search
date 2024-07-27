<?php 
namespace OSW3\Search;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use OSW3\Search\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SearchBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        (new Configuration)->generateProjectConfig($container->getParameter('kernel.project_dir'));
    }
}