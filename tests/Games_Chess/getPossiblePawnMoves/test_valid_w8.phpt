--TEST--
Games_Chess->getPossiblePawnMoves() valid white #8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->getPossiblePawnMoves('b3', 'W');
$phpunit->assertEquals(array('b4'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done