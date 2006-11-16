--TEST--
Games_Chess_Crazyhouse->_validMove() valid en passant pawn move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'e5');
$board->addPiece('B', 'P', 'd5');
$board->addPiece('W', 'K', 'e1');
$board->addPiece('B', 'K', 'e8');
$board->_enPassantSquare = 'd6';
$err = $board->_validMove($board->_parseMove('exd6'));
$phpunit->assertTrue($err, 'valid pawn move');
echo 'tests done';
?>
--EXPECT--
tests done