<?php

namespace Edsp\Mvc;

use ReflectionObject;

abstract class ExpandedObject
{
    public function is(object|string $objectOrClass): bool
    {
        if (is_string($objectOrClass)) {
            if (!class_exists($objectOrClass) && !interface_exists($objectOrClass))
                return false;
            $class = $objectOrClass;
        }
        else
            $class = get_class($objectOrClass);

        return is_a($this, $class) || is_subclass_of($this, $class);
    }

    public function getClass(): string {
        return get_class($this);
    }

    public function getReflection(): ReflectionObject {
        return new ReflectionObject($this);
    }
}