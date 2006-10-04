--TEST--
Games_Chess->_movePiece() pawn move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'e4');
$phpunit->assertEquals(array('e4', 'P'), $board->_pieces['WP1'], 'setup test');
$board->_movePiece('e4', 'e5');
$phpunit->assertEquals(array('e5', 'P'), $board->_pieces['WP1'], 'move test');
echo 'tests done';
?>
--EXPECT--
tests done