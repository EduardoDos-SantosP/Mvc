<?php

namespace Edsp\Mvc\Helpers\Query;

use Illuminate\Support\Collection;

class Projections
{
    protected Collection $items;

    public function __construct()
    {
        $this->items = new Collection();
    }

    public function addProjection(Projection $projection): self
    {
        $this->items->add($projection);
        return $this;
    }

    public function add(string $property): self
    {
        $this->addProjection(new Projection($property));
        return $this;
    }

    public function all(): Collection
    {
        return $this->items;
    }
}