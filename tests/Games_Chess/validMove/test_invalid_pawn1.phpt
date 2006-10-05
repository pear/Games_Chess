--TEST--
Games_Chess->_validMove() invalid pawn move #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'e2');
$err = $board->_validMove($board->_parseMove('exf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "exf3"'),
), 1);
echo 'tests done';
?>
--EXPECT--
tests done