--TEST--
Games_Chess->getPossiblePawnMoves() valid black #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'P', 'b5');
$err = $board->getPossiblePawnMoves('b7', 'B');
$phpunit->assertEquals(array('b6'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done