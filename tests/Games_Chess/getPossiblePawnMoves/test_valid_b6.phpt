--TEST--
Games_Chess->getPossiblePawnMoves() valid black #6
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'a6');
$board->addPiece('W', 'P', 'c6');
$err = $board->getPossiblePawnMoves('b7', 'B');
$phpunit->assertEquals(array('b6', 'b5','a6', 'c6'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done