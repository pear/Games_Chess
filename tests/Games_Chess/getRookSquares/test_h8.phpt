--TEST--
Games_Chess->getRookSquares() h8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getRookSquares('h8');
$phpunit->assertEquals(false, $ret['E'], 'East should not exist');
$phpunit->assertEquals(false, $ret['N'], 'North should not exist');
$phpunit->assertEquals(array('h7', 'h6', 'h5', 'h4', 'h3', 'h2', 'h1'),
    $ret['S'], 'South should contain some RookSquares');
$phpunit->assertEquals(array('g8', 'f8', 'e8', 'd8', 'c8', 'b8', 'a8'),
    $ret['W'], 'West should contain some RookSquares');
echo 'tests done';
?>
--EXPECT--
tests done