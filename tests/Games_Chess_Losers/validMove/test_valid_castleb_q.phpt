--TEST--
Games_Chess_Losers->validMove() valid castling, black queenside
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('B', 'K', 'e8');
$board->addPiece('B', 'R', 'a8');
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertTrue($err, 'error returned');
echo 'tests done';
?>
--EXPECT--
tests done