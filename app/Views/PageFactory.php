<?php

namespace Edsp\Mvc\Views;

use Edsp\Mvc\Views\Interfaces\IPage;
use Edsp\Mvc\Views\Interfaces\IViewFactory;
use Exception;

class PageFactory implements IViewFactory
{
    public static function createFromHtml(string $html): IPage
    {
        return new Page($html);
    }

    public static function createFromFile(string $path): IPage
    {
        if (!file_exists($path))
            throw new Exception(htmlspecialchars("O arquivo '$path' não foi encontrado!"));
        return new Page(file_get_contents($path));
    }

    public static function createFromViewFileName(string $fileName): IPage
    {
        return self::createFromFile(PROJECT_PATH . "/app/Views/Htmls/$fileName.php");
    }
}