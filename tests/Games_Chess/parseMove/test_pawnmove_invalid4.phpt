--TEST--
Games_Chess->_parseMove() invalid pawn move #4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('a88');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => '"a88" is not a valid algebraic move')
), 'invalid error message');
echo 'tests done';
?>
--EXPECT--
tests done