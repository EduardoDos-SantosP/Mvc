<?php

namespace Edsp\Mvc\Controllers\Menu;

use Edsp\Mvc\Views\Interfaces\IParentView;

interface IMenuItemController
{
    public function getMenuItem(): IParentView;
}