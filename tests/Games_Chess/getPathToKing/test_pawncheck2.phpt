--TEST--
Games_Chess->getPathToKing() pawn check 2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'P', 'f2');
$board->addPiece('W', 'K', 'e1');
$err = $board->_getPathToKing('f2', 'e1');
$phpunit->assertEquals(array('f2'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done