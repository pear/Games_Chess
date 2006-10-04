--TEST--
Games_Chess->getPossiblePawnMoves() valid black #8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->getPossiblePawnMoves('b6', 'B');
$phpunit->assertEquals(array('b5'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done