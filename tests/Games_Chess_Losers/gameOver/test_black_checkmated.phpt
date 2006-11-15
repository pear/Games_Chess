--TEST--
Games_Chess_Losers->gameOver() black checkmated
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('B', 'K', 'h8');
$board->addPiece('W', 'K', 'g7');
$board->addPiece('W', 'R', 'h3');
$board->_move = 'B';
$phpunit->assertEquals('B', $board->gameOver(), 1);
$board->_move = 'W';
$phpunit->assertEquals('B', $board->gameOver(), 2);
echo 'tests done';
?>
--EXPECT--
tests done