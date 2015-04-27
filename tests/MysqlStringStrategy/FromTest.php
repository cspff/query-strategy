<?php

namespace AppDevl\QueryStrategy\Test\MysqlStringStrategy;

use AppDevl\QueryStrategy\MysqlStringStrategy;

class FromTest extends \PHPUnit_Framework_TestCase
{
    public function testWhenFirstElement_includesFrom()
    {
        $strategy = new MysqlStringStrategy();
        $query = $strategy->from('SELECT *', 'foo');
        $this->assertEquals('SELECT * FROM foo', $query);
    }

    /**
     * @expectedException AppDevl\QueryStrategy\InvalidResultingQueryException
     */
    public function testWhenNotFirstElement_throwsException()
    {
        $strategy = new MysqlStringStrategy();

	// Ramdom case in "FROM" so that we know the implementation is
	// case-insensitive:
	$query = $strategy->from('SELECT foo FroM bar', 'baz');
    }
    public function testTranslates()
    {
        $strategy = new MysqlStringStrategy(['to replace' => 'replaced']);
        $query = $strategy->from('SELECT *', 'to replace');
        $this->assertEquals('SELECT * FROM replaced', $query);
    }
}
