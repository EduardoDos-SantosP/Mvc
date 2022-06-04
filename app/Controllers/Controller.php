<?php

namespace Edsp\Mvc\Controllers;

use Edsp\Mvc\ExpandedObject;
use Edsp\Mvc\Views\Interfaces\IView;

abstract class Controller extends ExpandedObject
{
    public abstract function view(): IView;
}