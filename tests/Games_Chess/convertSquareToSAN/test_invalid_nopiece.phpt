--TEST--
Games_Chess->_convertSquareToSAN() no piece on a1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_convertSquareToSAN('a1', 'a3', 'R');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square a1')
), 'wrong error message');
echo 'tests done';
?>
--EXPECT--
tests done