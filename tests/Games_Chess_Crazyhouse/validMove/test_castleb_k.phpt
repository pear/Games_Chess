--TEST--
Games_Chess_Crazyhouse->_validMove() valid kingside castling (black)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->_move = 'B';
$board->addPiece('B', 'K', 'e8');
$board->addPiece('B', 'R', 'h8');
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertTrue($err, 'error returned');
echo 'tests done';
?>
--EXPECT--
tests done