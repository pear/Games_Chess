--TEST--
Games_Chess_Losers->gameOver() no pieces left (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('B', 'K', 'e8');
$board->addPiece('B', 'R', 'a8');
$board->addPiece('W', 'K', 'f3');
$board->_move = 'B';
$phpunit->assertEquals('W', $board->gameOver(), 1);
$board->_move = 'W';
$phpunit->assertEquals('W', $board->gameOver(), 2);
echo 'tests done';
?>
--EXPECT--
tests done