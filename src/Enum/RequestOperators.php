<?php
namespace OSW3\Pagination\Enum;

use OSW3\Search\Trait\EnumTrait;

enum RequestOperators: string 
{
    use EnumTrait;

    case EQUAL          = 'equal';
    case IS_NOT         = 'is-not';
    case LIKE           = 'like';
    case LEFT_LIKE      = 'left-like';
    case RIGHT_LIKE     = 'right-like';
    case NOT_LIKE       = 'not-like';
    case NOT_LEFT_LIKE  = 'not-left-like';
    case NOT_RIGHT_LIKE = 'not-right-like';
    case POST           = 'post';

    // < : inférieur à
    // > : supérieur à
    // <= : inférieur ou égal à
    // >= : supérieur ou égal à
    // IN : vérification de l'appartenance à un ensemble de valeurs
    // BETWEEN : vérification si une valeur se situe dans un intervalle donné
    // IS NULL : vérification si une valeur est NULL
    // IS NOT NULL : vérification si une valeur n'est pas NULL
}