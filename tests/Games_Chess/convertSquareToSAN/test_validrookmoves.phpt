--TEST--
Games_Chess->_convertSquareToSAN() valid rook moves
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'a5');
$err = $board->_convertSquareToSAN('a5', 'a7');
$phpunit->assertEquals('Ra7', $err, 'Ra7');

$board->addPiece('B', 'N', 'a7');
$err = $board->_convertSquareToSAN('a5', 'a7');
$phpunit->assertEquals('Rxa7', $err, 'Rxa7');

$board->blankBoard();
$board->addPiece('W', 'R', 'd5');
$board->addPiece('W', 'R', 'f5');
$err = $board->_convertSquareToSAN('d5', 'e5');
$phpunit->assertEquals('Rde5', $err, 'Rde5');
$board->addPiece('B', 'Q', 'e5');
$err = $board->_convertSquareToSAN('d5', 'e5');
$phpunit->assertEquals('Rdxe5', $err, 'Rdxe5');

$board->blankBoard();
$board->addPiece('W', 'R', 'd5');
$board->addPiece('W', 'R', 'd3');
$err = $board->_convertSquareToSAN('d5', 'd4');
$phpunit->assertEquals('R5d4', $err, 'R5d4');
$board->addPiece('B', 'Q', 'd4');
$err = $board->_convertSquareToSAN('d5', 'd4');
$phpunit->assertEquals('R5xd4', $err, 'R5xd4');

$board->blankBoard();
$board->addPiece('W', 'R', 'd5');
$board->addPiece('W', 'R', 'd3');
$board->addPiece('W', 'R', 'c4');
$board->addPiece('W', 'R', 'f4');
$err = $board->_convertSquareToSAN('d5', 'd4');
$phpunit->assertEquals('Rd5d4', $err, 'Rd5d4');
$board->addPiece('B', 'Q', 'd4');
$err = $board->_convertSquareToSAN('d5', 'd4');
$phpunit->assertEquals('Rd5xd4', $err, 'Rd5xd4');

echo 'tests done';
?>
--EXPECT--
tests done