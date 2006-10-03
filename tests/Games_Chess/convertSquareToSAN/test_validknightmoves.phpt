--TEST--
Games_Chess->_convertSquareToSAN() valid knight moves
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'a5');
$err = $board->_convertSquareToSAN('a5', 'b7');
$phpunit->assertEquals('Nb7', $err, 'Nb7');

$board->addPiece('B', 'N', 'b7');
$err = $board->_convertSquareToSAN('a5', 'b7');
$phpunit->assertEquals('Nxb7', $err, 'Nxb7');

$board->addPiece('W', 'N', 'd5');
$board->addPiece('W', 'N', 'h5');
$err = $board->_convertSquareToSAN('d5', 'f6');
$phpunit->assertEquals('Ndf6', $err, 'Ndf6');
$board->addPiece('B', 'Q', 'f6');
$err = $board->_convertSquareToSAN('d5', 'f6');
$phpunit->assertEquals('Ndxf6', $err, 'Ndxf6');

$board->blankBoard();
$board->addPiece('W', 'N', 'd5');
$board->addPiece('W', 'N', 'd3');
$err = $board->_convertSquareToSAN('d5', 'f4');
$phpunit->assertEquals('N5f4', $err, 'N5f4');
$board->addPiece('B', 'Q', 'f4');
$err = $board->_convertSquareToSAN('d5', 'f4');
$phpunit->assertEquals('N5xf4', $err, 'N5xf4');

$board->blankBoard();
$board->addPiece('W', 'N', 'd5');
$board->addPiece('W', 'N', 'd3');
$board->addPiece('W', 'N', 'h3');
$err = $board->_convertSquareToSAN('d5', 'f4');
$phpunit->assertEquals('Nd5f4', $err, 'Nd5f4');
$board->addPiece('B', 'Q', 'f4');
$err = $board->_convertSquareToSAN('d5', 'f4');
$phpunit->assertEquals('Nd5xf4', $err, 'Nd5xf4');

echo 'tests done';
?>
--EXPECT--
tests done