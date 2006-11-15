--TEST--
Games_Chess_Losers->_capturePossible() not possible (black) castling
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_move = 'B';
$board->addPiece('B', 'K', 'e8');
$board->addPiece('W', 'B', 'g8');
$phpunit->assertFalse($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done