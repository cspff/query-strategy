<?php

namespace AppDevl\QueryStrategy\Test\MysqlStringStrategy;

use AppDevl\QueryStrategy\MysqlStringStrategy;

class GroupByTest extends \PHPUnit_Framework_TestCase
{
    public function testWhenFirstElementItIncludesGroupBy()
    {
        $strategy = new MysqlStringStrategy();
        $query = $strategy->groupBy('SELECT * FROM foo', 'bar');
        $this->assertEquals('SELECT * FROM foo GROUP BY bar', $query);
    }

    public function testWhenNotFirstElementItUsesCommaInsteadOfGroupBy()
    {
        $strategy = new MysqlStringStrategy();

        // Random case in "GROUP BY" so that we know the implementation is
        // case-insensitive:
        $query = $strategy->groupBy('SELECT * from foo GrOUp bY bar', 'baz');
        $this->assertEquals('SELECT * from foo GrOUp bY bar, baz', $query);
    }
    public function testTranslates()
    {
        $strategy = new MysqlStringStrategy(array('to replace' => 'replaced'));
        $query = $strategy->groupBy('SELECT * FROM foo', 'to replace');
        $this->assertEquals('SELECT * FROM foo GROUP BY replaced', $query);
    }
}
