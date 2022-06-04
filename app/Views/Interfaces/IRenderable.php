<?php

namespace Edsp\Mvc\Views\Interfaces;

interface IRenderable
{
    public function toString(): string;

    public function render(): void;
}