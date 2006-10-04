--TEST--
Games_Chess->getPossibleMoves() invalid piece
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->getPossibleMoves('T', 'a1', 'B');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => '"T" is not a valid piece, must be P, Q, R, N, K or B')
), 1);
echo 'tests done';
?>
--EXPECT--
tests done