--TEST--
Games_Chess->getRookSquares() a1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getRookSquares('a1');
$phpunit->assertEquals(false, $ret['S'], 'South should not exist');
$phpunit->assertEquals(false, $ret['W'], 'West should not exist');
$phpunit->assertEquals(array('a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8'),
    $ret['N'], 'North should contain some RookSquares');
$phpunit->assertEquals(array('b1', 'c1', 'd1', 'e1', 'f1', 'g1', 'h1'),
    $ret['E'], 'East should contain some RookSquares');
$ret = $board->_getRookSquares('a1', true);
$phpunit->assertEquals(array('a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8', 'b1',
            'c1', 'd1', 'e1', 'f1', 'g1', 'h1'),
            $ret, 'simple array');
echo 'tests done';
?>
--EXPECT--
tests done