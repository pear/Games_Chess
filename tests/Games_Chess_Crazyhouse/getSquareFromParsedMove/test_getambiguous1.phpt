--TEST--
Games_Chess_Crazyhouse->_getSquareFromParsedMove() get ambiguous 1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'Q', 'h2');
$board->addPiece('W', 'Q', 'h6');
$a = $board->_parseMove('Q6h4');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('h6', $err, 'wrong queen square');
echo 'tests done';
?>
--EXPECT--
tests done