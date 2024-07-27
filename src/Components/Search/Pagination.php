<?php 
namespace OSW3\Search\Components\Search;

use OSW3\Search\Service\PaginationService;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@Search/pagination/base.twig')]
final class Pagination 
{
}