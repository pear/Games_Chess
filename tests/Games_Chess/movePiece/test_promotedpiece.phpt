--TEST--
Games_Chess->_movePiece() promoted piece move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'e4');
$board->addPiece('W', 'B', 'e5');
$board->addPiece('W', 'B', 'e6');
$phpunit->assertEquals(array('e6', 'B'), $board->_pieces['WP1'], 'setup test');
$board->_movePiece('e6', 'd5');
$phpunit->assertEquals(array('d5', 'B'), $board->_pieces['WP1'], 'move test');
echo 'tests done';
?>
--EXPECT--
tests done