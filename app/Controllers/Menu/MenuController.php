<?php

namespace Edsp\Mvc\Controllers\Menu;

use DirectoryIterator;
use Edsp\Mvc\Controllers\Controller;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\Interfaces\IView;
use Edsp\Mvc\Views\ViewFactory;
use ReflectionClass;

class MenuController extends Controller
{
    public function view(): IView
    {
        /*** @var IParentView $menu */
        $menu = ViewFactory::createFromViewFileName('Menu');
        $items = '';

        $directory = new DirectoryIterator(PROJECT_PATH . '/app/Controllers');
        foreach ($directory as $item) {
            if (!$item->isFile()) continue;

            $fileName = $item->getFilename();
            $className = CONTROLLERS_NAMESPACE . '\\' . substr($fileName, 0, -strlen('.php'));
            if (!class_exists($className)) continue;

            if (!($reflection = new ReflectionClass($className))
                ->implementsInterface(IMenuItemController::class))
                continue;

            /*** @var IMenuItemController $controller */
            $controller = $reflection->newInstanceWithoutConstructor();

            $items .= $controller->getMenuItem();
        }

        return $menu->setChild('items', ViewFactory::createFromHtml($items));
    }
}