<?php

namespace Edsp\Mvc\Views\Interfaces;

interface IViewFactory
{
    public static function createFromHtml(string $html): IView;

    public static function createFromFile(string $path): IView;

    public static function createFromViewFileName(string $fileName): IView;
}