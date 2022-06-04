<?php

namespace Edsp\Mvc\Controllers;

use Edsp\Mvc\Annotations\ControllerMenuItemAnnotation;
use Edsp\Mvc\Controllers\Menu\IMenuItemController;
use Edsp\Mvc\Views\Interfaces\IView;
use Edsp\Mvc\Views\ViewFactory;

#[ControllerMenuItemAnnotation('Sobre')]
class AboutController extends PageController implements IMenuItemController
{
    protected function pageContent(): IView
    {
        return ViewFactory::createFromHtml('<div class="container">Sobre</div>');
    }

    public function getMenuItem(): IView
    {
        return parent::getMenuItem();
    }
}