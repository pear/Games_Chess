--TEST--
Games_Chess->_getSquareFromParsedMove() invalid Ka1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'h2');
$a = $board->_parseMove('Ka1');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertErrors(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Ka1"')
, 1);
echo 'tests done';
?>
--EXPECT--
tests done