--TEST--
Games_Chess->_convertSquareToSAN() valid king moves
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'a5');
$err = $board->_convertSquareToSAN('a5', 'a6');
$phpunit->assertEquals('Ka6', $err, 'Ka6');

$board->addPiece('B', 'N', 'a6');
$err = $board->_convertSquareToSAN('a5', 'a6');
$phpunit->assertEquals('Kxa6', $err, 'Kxa6');

// castling
$board->blankBoard();
$board->_WCastleK = true;
$board->addPiece('W', 'K', 'e1');
$board->addPiece('W', 'R', 'h1');
$err = $board->_convertSquareToSAN('e1', 'g1');
$phpunit->assertEquals('O-O', $err, 'O-O');

$board->blankBoard();
$board->_WCastleQ = true;
$board->addPiece('W', 'K', 'e1');
$board->addPiece('W', 'R', 'a1');
$err = $board->_convertSquareToSAN('e1', 'c1');
$phpunit->assertEquals('O-O-O', $err, 'O-O-O');

$board->blankBoard();
$board->_BCastleK = true;
$board->_move = 'B';
$board->addPiece('B', 'K', 'e8');
$board->addPiece('B', 'R', 'h8');
$err = $board->_convertSquareToSAN('e8', 'g8');
$phpunit->assertEquals('O-O', $err, 'O-O');

$board->blankBoard();
$board->_BCastleQ = true;
$board->_move = 'B';
$board->addPiece('B', 'K', 'e8');
$board->addPiece('B', 'R', 'a8');
$err = $board->_convertSquareToSAN('e8', 'c8');
$phpunit->assertEquals('O-O-O', $err, 'O-O-O');
echo 'tests done';
?>
--EXPECT--
tests done