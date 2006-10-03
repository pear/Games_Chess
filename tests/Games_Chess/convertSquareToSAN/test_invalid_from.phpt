--TEST--
Games_Chess->_convertSquareToSAN() non-existing a9 from square
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_convertSquareToSAN('a9', 'a3', 'R');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => '"a9" is not a valid square, must be between a1 and h8')
), 'wrong error message');
echo 'tests done';
?>
--EXPECT--
tests done