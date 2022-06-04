<?php

namespace Edsp\Mvc\Views;

use Exception;

class ViewFactory
{
    public static function createFromHtml(string $html): AbstractView
    {
        return new View($html);
    }

    public static function createFromFile(string $path): AbstractView
    {
        if (!file_exists($path))
            throw new Exception(htmlspecialchars("O arquivo '$path' não foi encontrado!"));
        return new View(file_get_contents($path));
    }

    public static function createFromViewFileName(string $fileName): AbstractView
    {
        return self::createFromFile(PROJECT_PATH . "/app/Views/Htmls/$fileName.php");
    }
}