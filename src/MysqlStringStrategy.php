<?php

namespace AppDevl\QueryStrategy;

class MysqlStringStrategy implements StrategyInterface
{
    public function select($expression, $query_to_append)
    {
        if (stripos($query_to_append, 'SELECT') !== false) {
            return $query_to_append . ', ' . $expression;
        } else {
            return 'SELECT ' . $expression;
        }
    }

    public function leftJoin($expression, $query_to_append)
    {
    }
}