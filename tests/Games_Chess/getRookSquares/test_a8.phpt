--TEST--
Games_Chess->getRookSquares() a8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getRookSquares('a8');
$phpunit->assertEquals(false, $ret['W'], 'West should not exist');
$phpunit->assertEquals(false, $ret['N'], 'North should not exist');
$phpunit->assertEquals(array('a7', 'a6', 'a5', 'a4', 'a3', 'a2', 'a1'),
    $ret['S'], 'South should contain some RookSquares');
$phpunit->assertEquals(array('b8', 'c8', 'd8', 'e8', 'f8', 'g8', 'h8'),
    $ret['E'], 'East should contain some RookSquares');
echo 'tests done';
?>
--EXPECT--
tests done