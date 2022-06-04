<?php

namespace Edsp\Mvc\Views\Interfaces;

interface IChildView extends IView
{
    public function getParent(): ?IParentView;

    public function setParent(IParentView $parentView): static;
}