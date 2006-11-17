--TEST--
Games_Chess_Crazyhouse->_interposeOrCapture() piece check, interpose possible with placement
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_captured['W']['P']++;
$board->addPiece('W', 'K', 'e4');
$board->addPiece('B', 'B', 'b1');
$phpunit->assertTrue($board->_interposeOrCapture(
    $board->_getPathToKing('b1', 'e4'), 'W'),1);

// try placing a pawn on the first rank
$board->blankBoard();
$board->_captured['W']['P']++;
$board->addPiece('W', 'K', 'e1');
$board->addPiece('B', 'R', 'b1');
$phpunit->assertFalse($board->_interposeOrCapture(
    $board->_getPathToKing('b1', 'e1'), 'W'), 2);
echo 'tests done';
?>
--EXPECT--
tests done