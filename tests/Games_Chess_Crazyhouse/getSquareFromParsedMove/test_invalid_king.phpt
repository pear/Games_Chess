--TEST--
Games_Chess_Crazyhouse->_getSquareFromParsedMove() invalid king
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'h2');
$a = $board->_parseMove('Ka1');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Ka1"')
), 'move 2');
echo 'tests done';
?>
--EXPECT--
tests done