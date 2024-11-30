<?php 
namespace OSW3\Search;

use OSW3\Search\Components\Search;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use OSW3\Search\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Yaml\Yaml;

class SearchBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $projectDir = $container->getParameter('kernel.project_dir');


        // Update dependency config
        // -- 

        $twig_component_Filepath = Path::join($projectDir, 'config/packages/twig_component.yaml' );
        
        if (file_exists($twig_component_Filepath))
        {
            $twig_component_YamlContent = file_get_contents( $twig_component_Filepath );
            $twig_component_ArrayContent = Yaml::parse($twig_component_YamlContent);
            
            // Search Bundle Components namespace
            $classPath = explode("\\", Search::class);
            array_pop($classPath);
            $templateDirectory = implode("\\", $classPath)."\\";

            $namePrefix = "@Search/";

            if (!isset( $twig_component_ArrayContent['twig_component']['defaults'][$templateDirectory] ))
            {
                file_put_contents($twig_component_Filepath, Yaml::dump(array_merge_recursive($twig_component_ArrayContent, ['twig_component' => ['defaults' => [$templateDirectory => $namePrefix]]]), 4));
            }
        }


        // Create Search.yaml config
        // --
        
        (new Configuration)->generateProjectConfig($projectDir);
    }
}