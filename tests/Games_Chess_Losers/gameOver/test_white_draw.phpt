--TEST--
Games_Chess_Losers->gameOver() white draw
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('W', 'K', 'h1');
$board->addPiece('W', 'P', 'a3');
$board->addPiece('B', 'P', 'a4');
$board->addPiece('B', 'P', 'h2');
$board->addPiece('B', 'K', 'h3');
$phpunit->assertEquals('D', $board->gameOver(), 1);
echo 'tests done';
?>
--EXPECT--
tests done