--TEST--
Games_Chess->getPossiblePawnMoves() valid white #5
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'P', 'a3');
$err = $board->getPossiblePawnMoves('b2', 'W');
$phpunit->assertEquals(array('b3', 'b4', 'a3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done