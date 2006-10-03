--TEST--
Games_Chess->_convertSquareToSAN() valid pawn moves
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'a7');
$err = $board->_convertSquareToSAN('a7', 'a8');
$phpunit->assertEquals('a8=Q', $err, 'a8=Q');
$board->blankBoard();
$board->addPiece('W', 'P', 'a7');
$err = $board->_convertSquareToSAN('a7', 'a8', 'R');
$phpunit->assertEquals('a8=R', $err, 'a8=R');
$board->blankBoard();
$board->addPiece('W', 'P', 'a7');
$err = $board->_convertSquareToSAN('a7', 'a8', 'N');
$phpunit->assertEquals('a8=N', $err, 'a8=N');
$board->blankBoard();
$board->addPiece('W', 'P', 'a7');
$err = $board->_convertSquareToSAN('a7', 'a8', 'Q');
$phpunit->assertEquals('a8=Q', $err, 'a8=Q');
$board->blankBoard();
$board->addPiece('W', 'P', 'a7');
$err = $board->_convertSquareToSAN('a7', 'a8', 'B');
$phpunit->assertEquals('a8=B', $err, 'a8=B');
$board->blankBoard();
$board->addPiece('W', 'P', 'a7');
$board->addPiece('B', 'R', 'b8');
$err = $board->_convertSquareToSAN('a7', 'b8');
$phpunit->assertEquals('axb8=Q', $err, 'axb8=Q');
echo 'tests done';
?>
--EXPECT--
tests done