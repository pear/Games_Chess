--TEST--
Games_Chess->getPossiblePawnMoves() invalid square
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->getPossiblePawnMoves('a9', 'B');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => '"a9" is not a valid square, must be between a1 and h8')
), 1);
echo 'tests done';
?>
--EXPECT--
tests done