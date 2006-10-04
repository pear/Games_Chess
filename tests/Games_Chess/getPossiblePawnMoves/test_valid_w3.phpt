--TEST--
Games_Chess->getPossiblePawnMoves() valid white #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'b4');
$err = $board->getPossiblePawnMoves('b2', 'W');
$phpunit->assertEquals(array('b3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done