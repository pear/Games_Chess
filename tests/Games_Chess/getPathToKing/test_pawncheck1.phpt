--TEST--
Games_Chess->getPathToKing() pawn check 1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'P', 'd2');
$board->addPiece('W', 'K', 'e1');
$err = $board->_getPathToKing('d2', 'e1');
$phpunit->assertEquals(array('d2'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done