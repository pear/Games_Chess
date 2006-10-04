--TEST--
Games_Chess->_interposeOrCapture() knight check, capture impossible
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e4');
$board->addPiece('B', 'N', 'd2');
$board->addPiece('W', 'Q', 'h5');
$phpunit->assertFalse($board->_interposeOrCapture(
    $board->_getPathToKing('d2', 'e4'), 'W'),1);
echo 'tests done';
?>
--EXPECT--
tests done