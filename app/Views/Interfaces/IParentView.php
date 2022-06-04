<?php

namespace Edsp\Mvc\Views\Interfaces;

use ArrayAccess;

interface IParentView extends IView, ArrayAccess
{
    public function setChild(int|string $slot, IView $child): static;

    public function contains(IView $child): bool;
}