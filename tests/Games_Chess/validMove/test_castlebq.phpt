--TEST--
Games_Chess->_validMove() valid castle queenside Black
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->_move = 'B';
$board->addPiece('W', 'K', 'e8');
$board->addPiece('W', 'R', 'a8');
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertTrue($err, 'error returned');
echo 'tests done';
?>
--EXPECT--
tests done