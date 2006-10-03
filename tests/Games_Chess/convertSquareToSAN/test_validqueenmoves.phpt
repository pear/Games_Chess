--TEST--
Games_Chess->_convertSquareToSAN() valid queen moves
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
// bishop moves
$board->addPiece('W', 'Q', 'a5');
$err = $board->_convertSquareToSAN('a5', 'c7');
$phpunit->assertEquals('Qc7', $err, 'Qb7');

$board->addPiece('B', 'N', 'c7');
$err = $board->_convertSquareToSAN('a5', 'c7');
$phpunit->assertEquals('Qxc7', $err, 'Qxc7');

$board->blankBoard();
$board->addPiece('W', 'Q', 'd5');
$board->addPiece('W', 'Q', 'f5');
$err = $board->_convertSquareToSAN('d5', 'e6');
$phpunit->assertEquals('Qde6', $err, 'Qde6');
$board->addPiece('B', 'Q', 'e6');
$err = $board->_convertSquareToSAN('d5', 'e6');
$phpunit->assertEquals('Qdxe6', $err, 'Qdxe6');

$board->blankBoard();
$board->addPiece('W', 'Q', 'd5');
$board->addPiece('W', 'Q', 'd3');
$err = $board->_convertSquareToSAN('d5', 'e4');
$phpunit->assertEquals('Q5e4', $err, 'Q5e4');
$board->addPiece('B', 'Q', 'e4');
$err = $board->_convertSquareToSAN('d5', 'e4');
$phpunit->assertEquals('Q5xe4', $err, 'Q5xe4');

$board->blankBoard();
$board->addPiece('W', 'Q', 'd5');
$board->addPiece('W', 'Q', 'd3');
$board->addPiece('W', 'Q', 'f3');
$err = $board->_convertSquareToSAN('d5', 'e4');
$phpunit->assertEquals('Qd5e4', $err, 'Qd5e4');
$board->addPiece('B', 'Q', 'e4');
$err = $board->_convertSquareToSAN('d5', 'e4');
$phpunit->assertEquals('Qd5xe4', $err, 'Qd5xe4');

// rook moves
$board->addPiece('W', 'Q', 'a5');
$err = $board->_convertSquareToSAN('a5', 'a7');
$phpunit->assertEquals('Qa7', $err, 'Qa7');

$board->addPiece('B', 'N', 'a7');
$err = $board->_convertSquareToSAN('a5', 'a7');
$phpunit->assertEquals('Qxa7', $err, 'Qxa7');

$board->blankBoard();
$board->addPiece('W', 'Q', 'd5');
$board->addPiece('W', 'Q', 'f5');
$err = $board->_convertSquareToSAN('d5', 'e5');
$phpunit->assertEquals('Qde5', $err, 'Qde5');
$board->addPiece('B', 'Q', 'e5');
$err = $board->_convertSquareToSAN('d5', 'e5');
$phpunit->assertEquals('Qdxe5', $err, 'Qdxe5');

$board->blankBoard();
$board->addPiece('W', 'Q', 'd5');
$board->addPiece('W', 'Q', 'd3');
$err = $board->_convertSquareToSAN('d5', 'd4');
$phpunit->assertEquals('Q5d4', $err, 'Q5d4');
$board->addPiece('B', 'Q', 'd4');
$err = $board->_convertSquareToSAN('d5', 'd4');
$phpunit->assertEquals('Q5xd4', $err, 'Q5xd4');

$board->blankBoard();
$board->addPiece('W', 'Q', 'd5');
$board->addPiece('W', 'Q', 'd3');
$board->addPiece('W', 'Q', 'c4');
$board->addPiece('W', 'Q', 'f4');
$err = $board->_convertSquareToSAN('d5', 'd4');
$phpunit->assertEquals('Qd5d4', $err, 'Qd5d4');
$board->addPiece('B', 'Q', 'd4');
$err = $board->_convertSquareToSAN('d5', 'd4');
$phpunit->assertEquals('Qd5xd4', $err, 'Qd5xd4');

echo 'tests done';
?>
--EXPECT--
tests done