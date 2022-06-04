<?php

namespace Edsp\Mvc\Controllers\Menu;

use Edsp\Mvc\Views\Interfaces\IView;

interface IMenuItemController
{
    public function getMenuItem(): IView;
}