--TEST--
Games_Chess->_convertSquareToSAN() valid pawn moves
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'a2');
$r = $board->_convertSquareToSAN('a2', 'a3');
$phpunit->assertEquals('a3', $r, 'a3');
$r = $board->_convertSquareToSAN('a2', 'a4');
$phpunit->assertEquals('a4', $r, 'a4');

$board->addPiece('B', 'P', 'b3');
$r = $board->_convertSquareToSAN('a2', 'b3');
$phpunit->assertEquals('axb3', $r, 'axb3');

$board->addPiece('W', 'P', 'a5');
$board->addPiece('B', 'P', 'b5');
$board->_enPassantSquare = 'b6';
$r = $board->_convertSquareToSAN('a5', 'b6');
$phpunit->assertEquals('axb6', $r, 'axb6');
echo 'tests done';
?>
--EXPECT--
tests done