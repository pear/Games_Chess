--TEST--
Games_Chess_Crazyhouse->toArray() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals(array (
  'board' => 
  array (
    'a8' => false,
    'b8' => false,
    'c8' => false,
    'd8' => false,
    'e8' => false,
    'f8' => false,
    'g8' => false,
    'h8' => false,
    'a7' => false,
    'b7' => false,
    'c7' => false,
    'd7' => false,
    'e7' => false,
    'f7' => false,
    'g7' => false,
    'h7' => false,
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
    'a2' => false,
    'b2' => false,
    'c2' => false,
    'd2' => false,
    'e2' => false,
    'f2' => false,
    'g2' => false,
    'h2' => false,
    'a1' => false,
    'b1' => false,
    'c1' => false,
    'd1' => false,
    'e1' => false,
    'f1' => false,
    'g1' => false,
    'h1' => false,
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