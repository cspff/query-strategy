<?php

namespace AppDevl\QueryStrategy\Test\MysqlStringStrategy;

use AppDevl\QueryStrategy\MysqlStringStrategy;

class LeftJoinTest extends \PHPUnit_Framework_TestCase
{
    public function testIncludesLeftJoin()
    {
        $strategy = new MysqlStringStrategy();
        $query = $strategy->leftJoin('SELECT * from first_table', 'second_table');
        $this->assertEquals("SELECT * from first_table\nLEFT JOIN second_table", $query);
    }

    public function testTranslates()
    {
        $strategy = new MysqlStringStrategy(['to replace' => 'replaced']);
        $query = $strategy->leftJoin('SELECT * from first_table', 'to replace', '');
        $this->assertEquals("SELECT * from first_table\nLEFT JOIN replaced", $query);
    }
}
