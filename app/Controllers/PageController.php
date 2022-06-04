<?php

namespace Edsp\Mvc\Controllers;

use Edsp\Mvc\Annotations\ControllerMenuItemAnnotation;
use Edsp\Mvc\Controllers\Menu\MenuController;
use Edsp\Mvc\Views\Interfaces\IPage;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\Interfaces\IView;
use Edsp\Mvc\Views\PageFactory;
use Edsp\Mvc\Views\ViewFactory;
use Exception;

abstract class PageController extends Controller
{
    public readonly IPage $page;

    public function __construct()
    {
        $this->page = $this->createPage();
    }

    protected function createPage(): IPage
    {
        return
            PageFactory::createFromViewFileName('BasePageLayout')
                ->setHead(
                    ViewFactory::createFromViewFileName('Head')
                )
                ->setBody(
                    ViewFactory::createFromViewFileName('Body')
                        ->setChild(
                            'header',
                            ViewFactory::createFromViewFileName('Header')
                                ->setChild('menu', (new MenuController())->view())
                        )
                        ->setChild('content', $this->pageContent())
                );
    }

    protected abstract function pageContent(): IView;

    public function view(): IView
    {
        return $this->page;
    }

    protected function getMenuItem(): ?IView
    {
        if (!($annotation = ControllerMenuItemAnnotation::fromController($this)))
            throw new Exception(
                static::class . " não utiliza a anotação " . ControllerMenuItemAnnotation::class . "!"
            );
        return $annotation->view();
    }
}