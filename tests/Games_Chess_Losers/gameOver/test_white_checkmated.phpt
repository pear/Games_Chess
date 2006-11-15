--TEST--
Games_Chess_Losers->gameOver() white checkmated
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('W', 'K', 'h8');
$board->addPiece('B', 'K', 'g7');
$board->addPiece('B', 'R', 'h3');
$phpunit->assertEquals('W', $board->gameOver(), 1);
$board->_move = 'B';
$phpunit->assertEquals('W', $board->gameOver(), 2);
echo 'tests done';
?>
--EXPECT--
tests done