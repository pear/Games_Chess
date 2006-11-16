--TEST--
Games_Chess_Crazyhouse->_getKing()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e3');
$board->addPiece('B', 'K', 'e5');
$phpunit->assertEquals('e3', $board->_getKing(), 'no arg 1');
$phpunit->assertEquals('e3', $board->_getKing('W'), 'W 1');
$phpunit->assertEquals('e5', $board->_getKing('B'), 'B 1');

$board->_move = 'B';
$phpunit->assertEquals('e5', $board->_getKing(), 'no arg 2');
$phpunit->assertEquals('e3', $board->_getKing('W'), 'W 2');
$phpunit->assertEquals('e5', $board->_getKing('B'), 'B 2');
echo 'tests done';
?>
--EXPECT--
tests done