--TEST--
Games_Chess_Losers->gameOver() pieces left
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('W', 'K', 'e8');
$board->addPiece('W', 'R', 'a8');
$board->addPiece('B', 'K', 'f3');
$board->addPiece('B', 'R', 'a3');
$board->_move = 'B';
$phpunit->assertFalse($board->gameOver(), '1');
$board->_move = 'W';
$phpunit->assertFalse($board->gameOver(), '2');
echo 'tests done';
?>
--EXPECT--
tests done