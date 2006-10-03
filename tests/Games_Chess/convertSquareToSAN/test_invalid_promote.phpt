--TEST--
Games_Chess->_convertSquareToSAN() invalid promote to "T"
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_convertSquareToSAN('a1', 'a3', 'T');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => '"T" is not a valid promotion piece, must be Q, R, N or B')
), 'wrong error message');
echo 'tests done';
?>
--EXPECT--
tests done