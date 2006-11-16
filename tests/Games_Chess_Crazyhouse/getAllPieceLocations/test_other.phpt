--TEST--
Games_Chess_Crazyhouse->_getAllPieceLocations() starting position
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->moveSAN('e4');
$phpunit->assertNoErrors('e4');
$board->moveSAN('d5');
$phpunit->assertNoErrors('d5');
$board->moveSAN('exd5');
$phpunit->assertNoErrors('exd5');
$board->moveSAN('Qxd5');
$phpunit->assertNoErrors('Qxd5');
$board->moveSAN('P@d4');
$phpunit->assertNoErrors('P@d4');
$board->moveSAN('P@e5');
$phpunit->assertNoErrors('P@e5');

$phpunit->assertEquals(array (
  0 => 'a2',
  1 => 'b2',
  2 => 'c2',
  3 => 'd2',
  4 => 'f2',
  5 => 'g2',
  6 => 'h2',
  7 => 'd4',
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
  3 => 'e7',
  4 => 'f7',
  5 => 'g7',
  6 => 'h7',
  7 => 'e5',
  8 => 'c8',
  9 => 'f8',
  10 => 'b8',
  11 => 'g8',
  12 => 'd5',
  13 => 'a8',
  14 => 'h8',
  15 => 'e8',
), $board->_getAllPieceLocations('B'), 'black');
echo 'tests done';
?>
--EXPECT--
tests done