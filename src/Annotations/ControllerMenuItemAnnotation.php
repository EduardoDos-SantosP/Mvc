<?php

namespace Edsp\Mvc\Annotations;

use Attribute;
use Edsp\Mvc\Controllers\PageController;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\ViewFactory;

#[Attribute]
class ControllerMenuItemAnnotation
{
    private string $label;
    private PageController $controller;

    public function __construct(string $label)
    {
        $this->label = $label;
    }

    public static function fromController(PageController $controller): ?self
    {
        if (!($annotation = $controller->getReflection()->getAttributes(self::class)))
            return null;

        $annotation = $annotation[0];

        /*** @var ControllerMenuItemAnnotation $instance */
        $instance = $annotation->newInstance();
        $instance->controller = $controller;
        return $instance;
    }

    public function view(): IParentView
    {
        /*** @var IParentView $menuItem */
        $menuItem = ViewFactory::createFromViewFileName('MenuItem');

        $menuItem->setChild('label', ViewFactory::createFromHtml($this->label));

        $urlController =
            PROJECT_URL .
            '/' . substr(
                $this->controller->getReflection()->getShortName(),
                0,
                -strlen('Controller')
            );

        $menuItem->setChild('link', ViewFactory::createFromHtml($urlController));

        return $menuItem;
    }
}