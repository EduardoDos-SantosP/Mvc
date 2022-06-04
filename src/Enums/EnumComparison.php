<?php

namespace Edsp\Mvc\Enums;

enum EnumComparison: string
{
    case Equal = '=';
    case Different = '<>';
    case LessThan = '<';
    case LessEqual = '<=';
    case GreaterThan = '>';
    case GreaterEqual = '>=';

}