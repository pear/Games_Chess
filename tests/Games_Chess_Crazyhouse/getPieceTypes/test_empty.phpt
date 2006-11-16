--TEST--
Games_Chess_Crazyhouse->_getPieceTypes() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals(array (
  'W' => 
  array (
  ),
  'B' => 
  array (
  ),
), $board->_getPieceTypes(), 'test');
echo 'tests done';
?>
--EXPECT--
tests done