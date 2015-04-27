<?php

namespace AppDevl\QueryStrategy\Test\MysqlStringStrategy;

use AppDevl\QueryStrategy\MysqlStringStrategy;

class LeftJoinTest extends \PHPUnit_Framework_TestCase
{
    public function testincludesLeftJoin()
    {
        $strategy = new MysqlStringStrategy();
        $query = $strategy->leftJoin('SELECT * from first_table', 'second_table', 'first_table.field = second_table.field');
        $this->assertEquals("SELECT * from first_table\nLEFT JOIN second_table ON first_table.field = second_table.field", $query);
    }

    public function testTranslates()
    {
        $strategy = new MysqlStringStrategy(['to replace' => 'replaced']);
        $query = $strategy->leftJoin('SELECT * from first_table', 'to replace', '');
        $this->assertEquals("SELECT * from first_table\nLEFT JOIN replaced ON ", $query);
    }
}
