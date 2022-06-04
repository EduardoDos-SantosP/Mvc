<?php

namespace Edsp\Mvc\Views;

use Edsp\Mvc\Enums\EnumViewInstance;
use Edsp\Mvc\ExpandedObject;

trait ParentViewTrait
{
    protected ?AbstractView $parent = null;

    public function __construct(string $html, EnumViewInstance $mode)
    {
        parent::__construct($html, $mode);
    }

    public function setChild(string|int $slot, AbstractView $child): self
    {
        $this->offsetSet($slot, $child);
        return $this;
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->children->offsetExists($offset);
    }

    public function offsetGet(mixed $offset): AbstractView
    {
        return $this->children->offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $acceptedClass = AbstractView::class;
        if (!(is_subclass_of($value, ExpandedObject::class) && $value->is($acceptedClass)))
            throw new Exception("Não é possível atribuir um valor que não seja $acceptedClass!");
        $this->children->offsetSet($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->children->offsetUnset($offset);
    }
}