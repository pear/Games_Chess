--TEST--
Games_Chess->_parseMove() invalid placement of pawn on back rank
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('P@a1');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Placing a piece on the first or back rank is illegal (P@a1)')
), 'invalid error message');
$ret = $board->_parseMove('P@a8');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Placing a piece on the first or back rank is illegal (P@a8)')
), 'invalid error message');
echo 'tests done';
?>
--EXPECT--
tests done