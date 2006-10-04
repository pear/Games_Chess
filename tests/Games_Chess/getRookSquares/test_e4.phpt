--TEST--
Games_Chess->getRookSquares() e4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getRookSquares('e4');
$phpunit->assertEquals(array('d4', 'c4', 'b4', 'a4'),
    $ret['W'], 'West should should contain some RookSquares');
$phpunit->assertEquals(array('f4', 'g4', 'h4'),
    $ret['E'], 'East should contain some RookSquares');
$phpunit->assertEquals(array('e5', 'e6', 'e7', 'e8'),
    $ret['N'], 'North should should contain some RookSquares');
$phpunit->assertEquals(array('e3', 'e2', 'e1'),
    $ret['S'], 'South should contain some RookSquares');
echo 'tests done';
?>
--EXPECT--
tests done