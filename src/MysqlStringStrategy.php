<?php

namespace AppDevl\QueryStrategy;

class MysqlStringStrategy implements StrategyInterface
{
    private $translations;
    public function __construct(array $translations = [])
    {
        $this->translations = $translations;
    }

    public function select($query_to_append, $expression)
    {
        $expression = $this->translate($expression);
        if (stripos($query_to_append, 'SELECT') !== false) {
            return $query_to_append . ', ' . $expression;
        } else {
            return 'SELECT ' . $expression;
        }
    }

    public function from($query_to_append, $expression)
    {
        $expression = $this->translate($expression);
        if (stripos($query_to_append, 'FROM') !== false) {
            throw new InvalidResultingQueryException('You may not have more than one FROM statement');
        } else {
            return $query_to_append . ' FROM ' . $expression;
        }
    }

    public function leftJoin($query_to_append, $expression)
    {
        $expression = $this->translate($expression);
        return $query_to_append . "\nLEFT JOIN " . $expression;
    }

    private function translate($expression)
    {
        if (array_key_exists($expression, $this->translations))
        {
            $expression = $this->translations[$expression];
        }
        return $expression;
    }
}
