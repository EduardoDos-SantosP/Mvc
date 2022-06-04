<?php

namespace Edsp\Mvc\Helpers\Query;

class QueryArgs
{
    protected Projections $projections;
    protected Restrictions $restrictions;

    public function __construct(Projections $projections, Restrictions $restrictions)
    {
        $this->projections = $projections;
        $this->restrictions = $restrictions;
    }

    public function mountProjectionString(MappedModel $map): string
    {
        $props = $map->getProps();
        return trim($map->getCols()->reduce(
            fn($str, $col, $i) => " $str $col AS $props[$i],",
            ''
        ));
    }
}