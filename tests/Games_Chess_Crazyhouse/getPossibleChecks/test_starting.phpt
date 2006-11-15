--TEST--
Games_Chess_Crazyhouse->_getPossibleChecks() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$phpunit->assertEquals(array (
  'WP0' => 
  array (
    0 => 'a3',
    1 => 'a4',
  ),
  'WP1' => 
  array (
    0 => 'b3',
    1 => 'b4',
  ),
  'WP2' => 
  array (
    0 => 'c3',
    1 => 'c4',
  ),
  'WP3' => 
  array (
    0 => 'd3',
    1 => 'd4',
  ),
  'WP4' => 
  array (
    0 => 'e3',
    1 => 'e4',
  ),
  'WP5' => 
  array (
    0 => 'f3',
    1 => 'f4',
  ),
  'WP6' => 
  array (
    0 => 'g3',
    1 => 'g4',
  ),
  'WP7' => 
  array (
    0 => 'h3',
    1 => 'h4',
  ),
  'WB0' => 
  array (
  ),
  'WB1' => 
  array (
  ),
  'WN0' => 
  array (
    0 => 'a3',
    1 => 'c3',
  ),
  'WN1' => 
  array (
    0 => 'f3',
    1 => 'h3',
  ),
  'WQ0' => 
  array (
  ),
  'WR0' => 
  array (
  ),
  'WR1' => 
  array (
  ),
  'WK0' => 
  array (
  ),
), $board->_getPossibleChecks('W'),
    '1');
$phpunit->assertEquals(array (
  'BP0' => 
  array (
    0 => 'a6',
    1 => 'a5',
  ),
  'BP1' => 
  array (
    0 => 'b6',
    1 => 'b5',
  ),
  'BP2' => 
  array (
    0 => 'c6',
    1 => 'c5',
  ),
  'BP3' => 
  array (
    0 => 'd6',
    1 => 'd5',
  ),
  'BP4' => 
  array (
    0 => 'e6',
    1 => 'e5',
  ),
  'BP5' => 
  array (
    0 => 'f6',
    1 => 'f5',
  ),
  'BP6' => 
  array (
    0 => 'g6',
    1 => 'g5',
  ),
  'BP7' => 
  array (
    0 => 'h6',
    1 => 'h5',
  ),
  'BB0' => 
  array (
  ),
  'BB1' => 
  array (
  ),
  'BN0' => 
  array (
    0 => 'c6',
    1 => 'a6',
  ),
  'BN1' => 
  array (
    0 => 'h6',
    1 => 'f6',
  ),
  'BQ0' => 
  array (
  ),
  'BR0' => 
  array (
  ),
  'BR1' => 
  array (
  ),
  'BK0' => 
  array (
  ),
), $board->_getPossibleChecks('B'),
    '2');
echo 'tests done';
?>
--EXPECT--
tests done