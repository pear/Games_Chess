--TEST--
Games_Chess_Crazyhouse->_getAllPieceLocations() starting position
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$phpunit->assertEquals(array (
  0 => 'a2',
  1 => 'b2',
  2 => 'c2',
  3 => 'd2',
  4 => 'e2',
  5 => 'f2',
  6 => 'g2',
  7 => 'h2',
  8 => 'c1',
  9 => 'f1',
  10 => 'b1',
  11 => 'g1',
  12 => 'd1',
  13 => 'a1',
  14 => 'h1',
  15 => 'e1',
), $board->_getAllPieceLocations('W'), 'white');
$phpunit->assertEquals(array (
  0 => 'a7',
  1 => 'b7',
  2 => 'c7',
  3 => 'd7',
  4 => 'e7',
  5 => 'f7',
  6 => 'g7',
  7 => 'h7',
  8 => 'c8',
  9 => 'f8',
  10 => 'b8',
  11 => 'g8',
  12 => 'd8',
  13 => 'a8',
  14 => 'h8',
  15 => 'e8',
), $board->_getAllPieceLocations('B'), 'black');
echo 'tests done';
?>
--EXPECT--
tests done