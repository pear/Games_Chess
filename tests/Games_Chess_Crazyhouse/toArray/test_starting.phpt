--TEST--
Games_Chess_Crazyhouse->toArray() starting position
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$phpunit->assertEquals(array (
  'board' => 
  array (
    'a8' => 'r',
    'b8' => 'n',
    'c8' => 'b',
    'd8' => 'q',
    'e8' => 'k',
    'f8' => 'b',
    'g8' => 'n',
    'h8' => 'r',
    'a7' => 'p',
    'b7' => 'p',
    'c7' => 'p',
    'd7' => 'p',
    'e7' => 'p',
    'f7' => 'p',
    'g7' => 'p',
    'h7' => 'p',
    'a6' => false,
    'b6' => false,
    'c6' => false,
    'd6' => false,
    'e6' => false,
    'f6' => false,
    'g6' => false,
    'h6' => false,
    'a5' => false,
    'b5' => false,
    'c5' => false,
    'd5' => false,
    'e5' => false,
    'f5' => false,
    'g5' => false,
    'h5' => false,
    'a4' => false,
    'b4' => false,
    'c4' => false,
    'd4' => false,
    'e4' => false,
    'f4' => false,
    'g4' => false,
    'h4' => false,
    'a3' => false,
    'b3' => false,
    'c3' => false,
    'd3' => false,
    'e3' => false,
    'f3' => false,
    'g3' => false,
    'h3' => false,
    'a2' => 'P',
    'b2' => 'P',
    'c2' => 'P',
    'd2' => 'P',
    'e2' => 'P',
    'f2' => 'P',
    'g2' => 'P',
    'h2' => 'P',
    'a1' => 'R',
    'b1' => 'N',
    'c1' => 'B',
    'd1' => 'Q',
    'e1' => 'K',
    'f1' => 'B',
    'g1' => 'N',
    'h1' => 'R',
  ),
  'captured' => 
  array (
    'W' => 
    array (
      'P' => 0,
      'B' => 0,
      'N' => 0,
      'Q' => 0,
      'R' => 0,
    ),
    'B' => 
    array (
      'P' => 0,
      'B' => 0,
      'N' => 0,
      'Q' => 0,
      'R' => 0,
    ),
  ),
), $board->toArray(), 1);
echo 'tests done';
?>
--EXPECT--
tests done