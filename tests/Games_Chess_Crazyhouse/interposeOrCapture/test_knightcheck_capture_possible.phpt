--TEST--
Games_Chess_Crazyhouse->_interposeOrCapture() knight check, capture possible
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e4');
$board->addPiece('B', 'N', 'd2');
$board->addPiece('W', 'Q', 'h6');
$phpunit->assertTrue($board->_interposeOrCapture(
    $board->_getPathToKing('d2', 'e4'), 'W'),1);
echo 'tests done';
?>
--EXPECT--
tests done