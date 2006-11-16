--TEST--
Games_Chess_Crazyhouse->_getPieceTypes() placed pieces
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_captured['B']['B']++;
$board->addPiece('B', 'B', 'a1');
$board->addPiece('B', 'B', 'a2');
$board->addPiece('B', 'B', 'a3');
$board->addPiece('B', 'B', 'a4');
$board->addPiece('B', 'B', 'a5');
$phpunit->assertEquals(array (
  'W' => 
  array (
  ),
  'B' => 
  array (
    'B' => 
    array (
      0 => 'B',
      1 => 'W',
      2 => 'B',
      3 => 'B',
      4 => 'W',
    ),
  ),
), $board->_getPieceTypes(), 'test');
echo 'tests done';
?>
--EXPECT--
tests done