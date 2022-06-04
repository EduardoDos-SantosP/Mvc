<?php

namespace Edsp\Mvc\Helpers\Query;

use Edsp\Mvc\Enums\EnumComparison;
use Illuminate\Support\Collection;

class Restrictions
{
    protected Collection $items;

    public function __construct()
    {
        $this->items = new Collection();
    }

    public function addRestriction(Restriction $projection): self
    {
        $this->items->add($projection);
        return $this;
    }

    public function add(string $property, mixed $value, EnumComparison $operator = EnumComparison::Equal): self
    {
        $this->addRestriction(new Restriction($property, $value, $operator));
        return $this;
    }

    public function all(): Collection
    {
        return $this->items;
    }
}