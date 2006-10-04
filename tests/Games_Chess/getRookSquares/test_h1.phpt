--TEST--
Games_Chess->getRookSquares() h1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getRookSquares('h1');
$phpunit->assertEquals(false, $ret['E'], 'East should not exist');
$phpunit->assertEquals(false, $ret['S'], 'South should not exist');
$phpunit->assertEquals(array('h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8'),
    $ret['N'], 'South should contain some RookSquares');
$phpunit->assertEquals(array('g1', 'f1', 'e1', 'd1', 'c1', 'b1', 'a1'),
    $ret['W'], 'West should contain some RookSquares');
echo 'tests done';
?>
--EXPECT--
tests done