--TEST--
Games_Chess->_convertSquareToSAN() valid bishop moves
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'a5');
$err = $board->_convertSquareToSAN('a5', 'c7');
$phpunit->assertEquals('Bc7', $err, 'Bb7');

$board->addPiece('B', 'N', 'c7');
$err = $board->_convertSquareToSAN('a5', 'c7');
$phpunit->assertEquals('Bxc7', $err, 'Bxc7');

$board->blankBoard();
$board->addPiece('W', 'B', 'd5');
$board->addPiece('W', 'B', 'f5');
$err = $board->_convertSquareToSAN('d5', 'e6');
$phpunit->assertEquals('Bde6', $err, 'Bde6');
$board->addPiece('B', 'Q', 'e6');
$err = $board->_convertSquareToSAN('d5', 'e6');
$phpunit->assertEquals('Bdxe6', $err, 'Bdxe6');

$board->blankBoard();
$board->addPiece('W', 'B', 'd5');
$board->addPiece('W', 'B', 'd3');
$err = $board->_convertSquareToSAN('d5', 'e4');
$phpunit->assertEquals('B5e4', $err, 'B5e4');
$board->addPiece('B', 'Q', 'e4');
$err = $board->_convertSquareToSAN('d5', 'e4');
$phpunit->assertEquals('B5xe4', $err, 'B5xe4');

$board->blankBoard();
$board->addPiece('W', 'B', 'd5');
$board->addPiece('W', 'B', 'd3');
$board->addPiece('W', 'B', 'f3');
$err = $board->_convertSquareToSAN('d5', 'e4');
$phpunit->assertEquals('Bd5e4', $err, 'Bd5e4');
$board->addPiece('B', 'Q', 'e4');
$err = $board->_convertSquareToSAN('d5', 'e4');
$phpunit->assertEquals('Bd5xe4', $err, 'Bd5xe4');

echo 'tests done';
?>
--EXPECT--
tests done