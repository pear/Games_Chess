--TEST--
Games_Chess->_convertSquareToSAN() invalid move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'a1');
$board->_convertSquareToSAN('a1', 'b3', 'R');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on a1 cannot move to b3')
), 'wrong error message');
echo 'tests done';
?>
--EXPECT--
tests done