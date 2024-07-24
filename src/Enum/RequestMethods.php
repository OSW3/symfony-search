<?php
namespace OSW3\Pagination\Enum;

use OSW3\Search\Trait\EnumTrait;

enum RequestMethods: string 
{
    use EnumTrait;

    case GET  = 'get';
    case POST = 'post';
}