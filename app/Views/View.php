<?php

namespace Edsp\Mvc\Views;

use Edsp\Mvc\ExpandedObject;
use Edsp\Mvc\Views\Interfaces\IChildView;
use Edsp\Mvc\Views\Interfaces\IParentView;
use Edsp\Mvc\Views\Interfaces\IView;
use Exception;

class View extends AbstractView implements IParentView, IChildView
{
    protected ?IParentView $parent = null;

    public function setChild(int|string $slot, IView $child): static
    {
        $this->offsetSet($slot, $child);
        return $this;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $acceptedClass = IView::class;
        if (!(is_subclass_of($value, ExpandedObject::class) && $value->is($acceptedClass)))
            throw new Exception("Não é possível atribuir um valor que não seja $acceptedClass!");

        $this->children->offsetSet($offset, $value);

        /*** @var IChildView $value */
        if ($value->is(IChildView::class))
            $value->setParent($this);
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->children->offsetExists($offset);
    }

    public function offsetGet(mixed $offset): AbstractView
    {
        return $this->children->offsetGet($offset);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->children->offsetUnset($offset);
    }

    public function getParent(): ?IParentView
    {
        return $this->parent;
    }

    public function setParent(IParentView $parentView): static
    {
        if (!$parentView->contains($this))
            throw new Exception("Não é possível definir a view pai pois ela não contém a view filha!");

        $this->parent = $parentView;

        return $this;
    }

    public function contains(IView $child): bool
    {
        return $this->children->contains($child);
    }
}