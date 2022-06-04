<?php

namespace Edsp\Mvc\Views\Interfaces;

use Edsp\Mvc\Views\ViewContext;

interface IView extends IRenderable
{
    public function __construct(string|ViewContext $html);
}