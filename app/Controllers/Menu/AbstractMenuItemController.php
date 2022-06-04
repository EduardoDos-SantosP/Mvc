<?php

namespace Edsp\Mvc\Controllers\Menu;

use Edsp\Mvc\Controllers\Controller;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\View;
use Edsp\Mvc\Views\ViewContext;

abstract class AbstractMenuItemController implements IMenuItemController
{
    protected IParentView $menuItem;

    public function __construct()
    {
        $this->menuItem = new View(ViewContext::viewFileName('MenuItem'));
    }

    public function getMenuItem(Controller $controller = null): IParentView
    {
        return $this->menuItem;
    }
}