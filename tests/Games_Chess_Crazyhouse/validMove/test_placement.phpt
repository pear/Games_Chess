--TEST--
Games_Chess_Crazyhouse->_validMove() valid placement
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$board->addPiece('B', 'P', 'a3');
$board->addPiece('B', 'P', 'h7');
$board->addPiece('W', 'P', 'b2');
$board->moveSAN('bxa3');
$board->moveSAN('h6');
$err = $board->_validMove($board->_parseMove('P@a5'));
$phpunit->assertTrue($err, 'first placement');
$board->resetGame();
$board->blankBoard();
$board->addPiece('B', 'P', 'a3');
$board->addPiece('B', 'P', 'h7');
$board->addPiece('W', 'P', 'b2');
$board->moveSAN('bxa3');
$board->moveSAN('h6');
$err = $board->_validMove($board->_parseMove('P@a5'));
$phpunit->assertTrue($err, 'second placement');
echo 'tests done';
?>
--EXPECT--
tests done