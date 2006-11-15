--TEST--
Games_Chess_Losers->_capturePossible() possible (black) #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_move = 'B';
$board->addPiece('B', 'N', 'c1');
$board->addPiece('W', 'B', 'd3');
$phpunit->assertTrue($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done