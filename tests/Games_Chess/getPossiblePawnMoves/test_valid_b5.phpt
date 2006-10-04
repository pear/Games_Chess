--TEST--
Games_Chess->getPossiblePawnMoves() valid black #5
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'a6');
$err = $board->getPossiblePawnMoves('b7', 'B');
$phpunit->assertEquals(array('b6', 'b5', 'a6'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done