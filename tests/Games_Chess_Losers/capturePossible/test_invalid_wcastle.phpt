--TEST--
Games_Chess_Losers->_capturePossible() not possible castle
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e1');
$board->addPiece('B', 'B', 'g1');
$phpunit->assertFalse($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done