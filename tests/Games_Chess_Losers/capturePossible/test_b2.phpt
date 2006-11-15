--TEST--
Games_Chess_Losers->_capturePossible() possible (black) #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_move = 'B';
$board->addPiece('B', 'K', 'e1');
$board->addPiece('W', 'B', 'f1');
$phpunit->assertTrue($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done