<?php

namespace Edsp\Mvc\Helpers\Query;

use Countable;
use Edsp\Mvc\Models\Model;
use Illuminate\Support\Collection;
use ReflectionObject;
use Symfony\Component\String\UnicodeString;

class MappedModel implements Countable
{
    private Collection $props;
    private Collection $cols;
    private int $count;

    public function __construct(Model $model)
    {
        $this->props = new Collection();
        $this->cols = new Collection();

        $reflectionProps = (new ReflectionObject($model))->getProperties();
        foreach ($reflectionProps as $prop) {
            $this->props->add($prop->getName());
            $this->cols->add((new UnicodeString($prop->getName()))->snake());
        }
        $this->count = $this->cols->count();
    }

    public function getProps(): Collection
    {
        return $this->props;
    }

    public function getCols(): Collection
    {
        return $this->cols;
    }

    public function count(): int
    {
        return $this->count;
    }
}