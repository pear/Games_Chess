--TEST--
Games_Chess_Crazyhouse->_getPossibleChecks() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('8/pppppppp/8/rnbqkbnr/8/RNBQKBNR/PPPPPPPP/8 w KQkq - 0 1');
$pieces = $board->_getPossibleChecks('W');
$phpunit->assertEquals(
    array (
  'WP0' => 
  array (
  ),
  'WP1' => 
  array (
  ),
  'WP2' => 
  array (
  ),
  'WP3' => 
  array (
  ),
  'WP4' => 
  array (
  ),
  'WP5' => 
  array (
  ),
  'WP6' => 
  array (
  ),
  'WP7' => 
  array (
  ),
  'WB0' => 
  array (
    0 => 'd4',
    1 => 'e5',
    2 => 'b4',
    3 => 'a5',
  ),
  'WB1' => 
  array (
    0 => 'g4',
    1 => 'h5',
    2 => 'e4',
    3 => 'd5',
  ),
  'WN0' => 
  array (
    0 => 'a5',
    1 => 'c5',
    2 => 'd4',
    3 => 'c1',
    4 => 'a1',
  ),
  'WN1' => 
  array (
    0 => 'e4',
    1 => 'f5',
    2 => 'h5',
    3 => 'h1',
    4 => 'f1',
  ),
  'WQ0' => 
  array (
    0 => 'd4',
    1 => 'd5',
    2 => 'e4',
    3 => 'f5',
    4 => 'c4',
    5 => 'b5',
  ),
  'WR0' => 
  array (
    0 => 'a4',
    1 => 'a5',
  ),
  'WR1' => 
  array (
    0 => 'h4',
    1 => 'h5',
  ),
  'WK0' => 
  array (
    0 => 'd4',
    1 => 'f4',
    2 => 'e4',
  ),
),
    $pieces, 'white moves are not right');
$pieces = $board->_getPossibleChecks('B');
$phpunit->assertEquals(
    array (
  'BP0' => 
  array (
    0 => 'a6',
  ),
  'BP1' => 
  array (
    0 => 'b6',
  ),
  'BP2' => 
  array (
    0 => 'c6',
  ),
  'BP3' => 
  array (
    0 => 'd6',
  ),
  'BP4' => 
  array (
    0 => 'e6',
  ),
  'BP5' => 
  array (
    0 => 'f6',
  ),
  'BP6' => 
  array (
    0 => 'g6',
  ),
  'BP7' => 
  array (
    0 => 'h6',
  ),
  'BB0' => 
  array (
    0 => 'd6',
    1 => 'b6',
    2 => 'd4',
    3 => 'e3',
    4 => 'b4',
    5 => 'a3',
  ),
  'BB1' => 
  array (
    0 => 'g6',
    1 => 'e6',
    2 => 'g4',
    3 => 'h3',
    4 => 'e4',
    5 => 'd3',
  ),
  'BN0' => 
  array (
    0 => 'd6',
    1 => 'd4',
    2 => 'c3',
    3 => 'a3',
  ),
  'BN1' => 
  array (
    0 => 'e6',
    1 => 'h3',
    2 => 'f3',
    3 => 'e4',
  ),
  'BQ0' => 
  array (
    0 => 'd6',
    1 => 'd4',
    2 => 'd3',
    3 => 'e6',
    4 => 'c6',
    5 => 'e4',
    6 => 'f3',
    7 => 'c4',
    8 => 'b3',
  ),
  'BR0' => 
  array (
    0 => 'a6',
    1 => 'a4',
    2 => 'a3',
  ),
  'BR1' => 
  array (
    0 => 'h6',
    1 => 'h4',
    2 => 'h3',
  ),
  'BK0' => 
  array (
    0 => 'd6',
    1 => 'd4',
    2 => 'f6',
    3 => 'f4',
    4 => 'e4',
    5 => 'e6',
  ),
),
    $pieces, 'black moves are not right');
echo 'tests done';
?>
--EXPECT--
tests done