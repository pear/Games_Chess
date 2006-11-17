--TEST--
Games_Chess_Crazyhouse->_interposeOrCapture() piece check, interpose possible
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e4');
$board->addPiece('B', 'B', 'b1');
$board->addPiece('W', 'Q', 'h2');
$phpunit->assertTrue($board->_interposeOrCapture(
    $board->_getPathToKing('b1', 'e4'), 'W'),1);
echo 'tests done';
?>
--EXPECT--
tests done