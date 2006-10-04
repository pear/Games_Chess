--TEST--
Games_Chess->getPossiblePawnMoves() valid black #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->getPossiblePawnMoves('b7', 'B');
$phpunit->assertEquals(array('b6', 'b5'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done