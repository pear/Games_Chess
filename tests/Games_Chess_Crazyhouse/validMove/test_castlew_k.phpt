--TEST--
Games_Chess_Crazyhouse->_validMove() valid kingside castling (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('W', 'K', 'e1');
$board->addPiece('W', 'R', 'h1');
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertTrue($err, 'error returned');
echo 'tests done';
?>
--EXPECT--
tests done