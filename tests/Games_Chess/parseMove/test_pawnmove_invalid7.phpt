--TEST--
Games_Chess->_parseMove() invalid pawn move #7
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('h8=K');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => '"h8=K" is not a valid algebraic move')
), 'invalid error message');
echo 'tests done';
?>
--EXPECT--
tests done