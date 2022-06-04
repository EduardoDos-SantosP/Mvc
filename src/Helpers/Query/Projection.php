<?php

namespace Edsp\Mvc\Helpers\Query;

class Projection
{
    protected string $property;
    protected ?string $alias;

    public function __construct(string $property, string $alias = null)
    {
        $this->property = $property;
        $this->alias = $alias;
    }

    public function getProperty(): string
    {
        return $this->property;
    }
    public function getAlias(): string
    {
        return $this->alias;
    }
}