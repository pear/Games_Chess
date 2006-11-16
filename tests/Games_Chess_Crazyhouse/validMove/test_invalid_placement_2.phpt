--TEST--
Games_Chess_Crazyhouse->_validMove() invalid placement move 2
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
$board->addPiece('W', 'B', 'a5');
$err = $board->_validMove($board->_parseMove('P@a5'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is already a piece on a5, cannot place another there')
), 'P@a5 1');

$board->resetGame();
$board->blankBoard();
$board->addPiece('B', 'P', 'a3');
$board->addPiece('B', 'P', 'h7');
$board->addPiece('W', 'P', 'b2');
$board->moveSAN('bxa3');
$board->moveSAN('h6');
$board->addPiece('B', 'B', 'a5');
$err = $board->_validMove($board->_parseMove('P@a5'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is already a piece on a5, cannot place another there')
), 'P@a5 2');
echo 'tests done';
?>
--EXPECT--
tests done