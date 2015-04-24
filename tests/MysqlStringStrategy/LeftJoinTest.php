<?php

namespace AppDevl\QueryStrategy\Test\MysqlStringStrategy;

use AppDevl\QueryStrategy\MysqlStringStrategy;

class LeftJoinTest extends \PHPUnit_Framework_TestCase
{
    public function testincludesLeftJoin()
    {
        $strategy = new MysqlStringStrategy();
        $query = $strategy->leftJoin('second_table', 'first_table.field = second_table.field', 'SELECT * from first_table');
        $this->assertEquals("SELECT * from first_table\nLEFT JOIN second_table ON first_table.field = second_table.field", $query);
    }
}
