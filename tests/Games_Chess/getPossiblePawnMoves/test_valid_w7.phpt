--TEST--
Games_Chess->getPossiblePawnMoves() valid white #7
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'a3');
$board->addPiece('W', 'P', 'c3');
$err = $board->getPossiblePawnMoves('b2', 'W');
$phpunit->assertEquals(array('b3', 'b4'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done