<?php

namespace Edsp\Mvc\Controllers;

use Edsp\Mvc\Annotations\ControllerMenuItemAnnotation;
use Edsp\Mvc\Controllers\Menu\IMenuItemController;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\Interfaces\IView;
use Edsp\Mvc\Views\ViewFactory;

#[ControllerMenuItemAnnotation('Início')]
class HomeController extends PageController implements IMenuItemController
{
    protected function pageContent(): IView
    {
        return ViewFactory::CreateFromViewFileName('Home');
    }

    public function getMenuItem(): IParentView
    {
        return parent::getMenuItem();
    }
}