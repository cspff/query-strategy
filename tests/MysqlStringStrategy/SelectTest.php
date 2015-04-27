<?php

namespace AppDevl\QueryStrategy\Test\MysqlStringStrategy;

use AppDevl\QueryStrategy\MysqlStringStrategy;

class SelectTest extends \PHPUnit_Framework_TestCase
{
    public function testWhenFirstElement_includesSelect()
    {
        $strategy = new MysqlStringStrategy();
        $query = $strategy->select('', '*');
        $this->assertEquals('SELECT *', $query);
    }

    public function testWhenNotFirstElement_commaInsteadOfSelect()
    {
        $strategy = new MysqlStringStrategy();

	// Ramdom case in "SELECT" so that we know the implementation is
	// case-insensitive:
	$query = $strategy->select('SeLEcT foo', 'bar');
        $this->assertEquals('SeLEcT foo, bar', $query);
    }
    public function testTranslates()
    {
        $strategy = new MysqlStringStrategy(['to replace' => 'replaced']);
        $query = $strategy->select('', 'to replace');
        $this->assertEquals('SELECT replaced', $query);
    }
}
