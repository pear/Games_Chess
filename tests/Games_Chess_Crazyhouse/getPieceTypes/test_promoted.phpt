--TEST--
Games_Chess_Crazyhouse->_getPieceTypes() promoted pawns
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'B', 'a1');
$board->addPiece('B', 'B', 'a2');
$board->addPiece('B', 'B', 'a3');
$phpunit->assertEquals(array (
  'W' => 
  array (
  ),
  'B' => 
  array (
    'B' => 
    array (
      0 => 'B',
      1 => 'B',
      2 => 'W',
    ),
  ),
), $board->_getPieceTypes(), 'test');
echo 'tests done';
?>
--EXPECT--
tests done