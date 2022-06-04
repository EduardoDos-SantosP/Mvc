<?php

namespace Edsp\Mvc\Controllers;

use Edsp\Mvc\Annotations\ControllerMenuItemAnnotation;
use Edsp\Mvc\Controllers\Menu\IMenuItemController;
use Edsp\Mvc\Views\AbstractView;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\ViewFactory;

#[ControllerMenuItemAnnotation('Início')]
class HomeController extends Controller implements IMenuItemController
{
    protected function pageContent(): AbstractView
    {
        return ViewFactory::CreateFromViewFileName('Home');
    }

    public function getMenuItem(): IParentView
    {
        return parent::getMenuItem();
    }
}