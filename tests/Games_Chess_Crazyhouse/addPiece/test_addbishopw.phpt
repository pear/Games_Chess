--TEST--
Games_Chess_Crazyhouse->addPiece() add white bishop
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['W']['B'][0],
    'incorrect bishop setup');
$board->addPiece('W', 'B', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['W']['B'][0],
    'first bishop changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['W']['B'][1],
    'incorrect bishop setup');
$board->addPiece('W', 'B', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['W']['B'][0],
    'first bishop changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['W']['B'][1],
    'first bishop changed, should not change');
$phpunit->assertEquals(array('h1','B'), $board->_pieces['W']['P'][0],
    'incorrect bishop setup');
echo 'tests done';
?>
--EXPECT--
tests done