--TEST--
Games_Chess_Losers->gameOver() black draw
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('B', 'K', 'h8');
$board->addPiece('W', 'P', 'a3');
$board->addPiece('B', 'P', 'a4');
$board->addPiece('W', 'P', 'h7');
$board->addPiece('W', 'K', 'h6');
$board->_move = 'B';
$phpunit->assertEquals('D', $board->gameOver(), 1);
echo 'tests done';
?>
--EXPECT--
tests done