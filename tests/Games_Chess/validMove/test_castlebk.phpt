--TEST--
Games_Chess->_validMove() valid castle kingside Black
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->_move = 'B';
$board->addPiece('W', 'K', 'e8');
$board->addPiece('W', 'R', 'h8');
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertTrue($err, 'error returned');
echo 'tests done';
?>
--EXPECT--
tests done