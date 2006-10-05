--TEST--
Games_Chess->_parseMove() invalid pawn move #6
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('axj8');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => '"axj8" is not a valid algebraic move')
), 'invalid error message');
echo 'tests done';
?>
--EXPECT--
tests done