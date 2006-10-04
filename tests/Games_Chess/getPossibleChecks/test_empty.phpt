--TEST--
Games_Chess->_getPossibleChecks() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->_getPossibleChecks('W');
$phpunit->assertEquals(array(), $err, 'W');
$err = $board->_getPossibleChecks('B');
$phpunit->assertEquals(array(), $err, 'B');
echo 'tests done';
?>
--EXPECT--
tests done