--TEST--
Games_Chess_Crazyhouse->_getSquareFromParsedMove() get ambiguous 2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'Q', 'h2');
$board->addPiece('W', 'Q', 'e4');
$a = $board->_parseMove('Qhh4');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('h2', $err, 'wrong queen square');
echo 'tests done';
?>
--EXPECT--
tests done