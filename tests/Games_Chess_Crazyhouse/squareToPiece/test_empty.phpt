--TEST--
Games_Chess_Crazyhouse->_squareToPiece() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertFalse($board->_squareToPiece('a1'), 1);
echo 'tests done';
?>
--EXPECT--
tests done