--TEST--
Games_Chess_Losers->validMove() valid pawn move 1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'e2');
$err = $board->_validMove($board->_parseMove('e3'));
$phpunit->assertTrue($err, 'move');
echo 'tests done';
?>
--EXPECT--
tests done