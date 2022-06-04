<?php

namespace Edsp\Mvc\Controllers;

use Edsp\Mvc\Annotations\ControllerMenuItemAnnotation;
use Edsp\Mvc\Controllers\Menu\MenuController;
use Edsp\Mvc\ExpandedObject;
use Edsp\Mvc\Helpers\Icon;
use Edsp\Mvc\Views\AbstractView;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\Page;
use Edsp\Mvc\Views\View;
use Edsp\Mvc\Views\ViewContext;
use Exception;

abstract class Controller extends ExpandedObject
{
    public readonly Page $page;

    public function __construct()
    {
        $this->page = $this->createPage();
    }

    protected function createPage(): Page
    {
        $page = new Page(ViewContext::viewFileName('BasePageLayout'));

        $header = new View(ViewContext::viewFileName('Header'));
        $header->statics['icon'] = Icon::class;
        $header->setChild(
            'menu',
            (new MenuController())->view()
        );

        $page->setHead(
            new View(ViewContext::viewFileName('Head'))
        )->setBody(
            (new View(ViewContext::viewFileName('Body')))
                ->setChild(
                    'header',
                    $header
                )
                ->setChild('content', $this->pageContent())
        );

        return $page;
    }

    protected abstract function pageContent(): AbstractView;

    public function view(): AbstractView
    {
        return $this->page;
    }

    protected function getMenuItem(): ?IParentView
    {
        if (!($annotation = ControllerMenuItemAnnotation::fromController($this)))
            throw new Exception(
                static::class . " não utiliza a anotação " . ControllerMenuItemAnnotation::class . "!"
            );
        return $annotation->view();
    }
}