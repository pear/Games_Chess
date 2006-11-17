--TEST--
Games_Chess_Crazyhouse->_movePiece()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e1');
$phpunit->assertEquals('8/8/8/8/8/8/8/4K3', $board->_renderFen(), 1);
$board->_moveAlgebraic('e1', 'e2');
$phpunit->assertEquals('8/8/8/8/8/8/4K3/8', $board->_renderFen(), 2);

$board->blankBoard();
$board->addPiece('W', 'P', 'e7');
$phpunit->assertEquals('8/4P3/8/8/8/8/8/8', $board->_renderFen(), 1);
$board->_moveAlgebraic('e7', 'e8', 'R');
$phpunit->assertEquals('4R3/8/8/8/8/8/8/8', $board->_renderFen(), 2);
echo 'tests done';
?>
--EXPECT--
tests done