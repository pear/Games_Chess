--TEST--
Games_Chess->getPossiblePawnMoves() valid white #9
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'P', 'a5');
$err = $board->getPossiblePawnMoves('b5', 'W');
$phpunit->assertEquals(array('b6'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done