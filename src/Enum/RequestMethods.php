<?php
namespace OSW3\Search\Enum;

use OSW3\Search\Trait\EnumTrait;

enum RequestMethods: string 
{
    use EnumTrait;

    case GET  = 'get';
    case POST = 'post';
}