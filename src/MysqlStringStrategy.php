<?php

namespace AppDevl\QueryStrategy;

class MysqlStringStrategy implements StrategyInterface
{
    public function select($query_to_append, $expression)
    {
        if (stripos($query_to_append, 'SELECT') !== false) {
            return $query_to_append . ', ' . $expression;
        } else {
            return 'SELECT ' . $expression;
        }
    }

    public function leftJoin($query_to_append, $expression, $on)
    {
        return $query_to_append . "\nLEFT JOIN " . $expression . ' ON ' . $on;
    }
}
