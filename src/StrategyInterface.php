<?php

namespace AppDevl\QueryStrategy;

interface StrategyInterface
{
    public function select($expression, $query_to_append);
    public function leftJoin($expression, $on, $query_to_append);
}
