--TEST--
Games_Chess_Crazyhouse->_getPieceTypes() starting position
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$phpunit->assertEquals(array (
  'W' => 
  array (
    'P' => 
    array (
      0 => 'W',
      1 => 'B',
      2 => 'W',
      3 => 'B',
      4 => 'W',
      5 => 'B',
      6 => 'W',
      7 => 'B',
    ),
    'B' => 
    array (
      0 => 'B',
      1 => 'W',
    ),
    'N' => 
    array (
      0 => 'W',
      1 => 'B',
    ),
    'Q' => 
    array (
      0 => 'W',
    ),
    'R' => 
    array (
      0 => 'B',
      1 => 'W',
    ),
    'K' => 
    array (
      0 => 'B',
    ),
  ),
  'B' => 
  array (
    'P' => 
    array (
      0 => 'B',
      1 => 'W',
      2 => 'B',
      3 => 'W',
      4 => 'B',
      5 => 'W',
      6 => 'B',
      7 => 'W',
    ),
    'B' => 
    array (
      0 => 'W',
      1 => 'B',
    ),
    'N' => 
    array (
      0 => 'B',
      1 => 'W',
    ),
    'Q' => 
    array (
      0 => 'B',
    ),
    'R' => 
    array (
      0 => 'W',
      1 => 'B',
    ),
    'K' => 
    array (
      0 => 'W',
    ),
  ),
), $board->_getPieceTypes(), 'test');
echo 'tests done';
?>
--EXPECT--
tests done