--TEST--
Games_Chess->_validMove() valid pawn move #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'e2');
$err = $board->_validMove($board->_parseMove('e3'));
$phpunit->assertTrue($err, 'valid pawn move');
echo 'tests done';
?>
--EXPECT--
tests done