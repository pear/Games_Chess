--TEST--
Games_Chess->_validMove() valid pawn move #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'e2');
$board->addPiece('W', 'K', 'e1');
$board->addPiece('B', 'Q', 'a5');
$err = $board->_validMove($board->_parseMove('Rd2'));
$phpunit->assertTrue($err, 'valid pawn move');
echo 'tests done';
?>
--EXPECT--
tests done