--TEST--
Games_Chess_Crazyhouse->_getPossibleChecks() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals(array(), $board->_getPossibleChecks('W'),
    'should be empty, and is not');
$phpunit->assertEquals(array(), $board->_getPossibleChecks('B'),
    'should be empty, and is not');
echo 'tests done';
?>
--EXPECT--
tests done