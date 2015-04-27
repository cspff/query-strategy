<?php

namespace AppDevl\QueryStrategy;

interface StrategyInterface
{
    public function select($query_to_append, $expression);
    public function leftJoin($query_to_append, $expression);
    public function from($query_to_append, $expression);
    public function groupBy($query_to_append, $expression);
}
