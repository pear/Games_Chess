--TEST--
Games_Chess_Crazyhouse->_renderFen() starting position
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e1');
$board->addPiece('W', 'R', 'd2');
$board->addPiece('W', 'R', 'd3');
$board->addPiece('W', 'R', 'd4');
$board->addPiece('B', 'K', 'e7');
$phpunit->assertEquals('8/4k3/8/8/3R4/3R4/3R4/4K3', $board->_renderFen(), 1);
echo 'tests done';
?>
--EXPECT--
tests done