<?php

namespace Edsp\Mvc\Helpers\Query;

use Edsp\Mvc\Enums\EnumComparison;

class Restriction
{
    protected string $property;
    protected EnumComparison $operator;
    protected mixed $value;

    public function __construct(string $property, mixed $value, EnumComparison $operator = EnumComparison::Equal)
    {
        $this->property = $property;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function getOperator(): EnumComparison
    {
        return $this->operator;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}