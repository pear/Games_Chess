--TEST--
Games_Chess_Crazyhouse->_getSquareFromParsedMove() get ambiguous 4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'Q', 'h2');
$board->addPiece('W', 'Q', 'e4');
$board->addPiece('W', 'Q', 'a1');
$a = $board->_parseMove('Qaa2');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('a1', $err, 'wrong queen square');
echo 'tests done';
?>
--EXPECT--
tests done