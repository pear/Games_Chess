--TEST--
Games_Chess->_convertSquareToSAN() a1 is not your piece
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'a1');
$board->_convertSquareToSAN('a1', 'a3', 'R');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on a1 is not your piece')
), 'wrong error message');
echo 'tests done';
?>
--EXPECT--
tests done