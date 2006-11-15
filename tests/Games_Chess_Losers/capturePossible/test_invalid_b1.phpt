--TEST--
Games_Chess_Losers->_capturePossible() not possible (black) #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_move = 'B';
$board->addPiece('B', 'B', 'c1');
$phpunit->assertFalse($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done