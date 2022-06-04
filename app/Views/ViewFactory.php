<?php

namespace Edsp\Mvc\Views;

use Edsp\Mvc\Views\Interfaces\IChildView;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\Interfaces\IViewFactory;
use Exception;

class ViewFactory implements IViewFactory
{
    public static function createFromHtml(string $html): IParentView&IChildView
    {
        return new View($html);
    }

    public static function createFromFile(string $path): IParentView&IChildView
    {
        if (!file_exists($path))
            throw new Exception(htmlspecialchars("O arquivo '$path' não foi encontrado!"));
        return new View(file_get_contents($path));
    }

    public static function createFromViewFileName(string $fileName): IParentView&IChildView
    {
        return self::createFromFile(PROJECT_PATH . "/app/Views/Htmls/$fileName.php");
    }
}