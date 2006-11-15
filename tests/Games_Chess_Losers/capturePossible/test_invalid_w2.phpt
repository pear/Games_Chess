--TEST--
Games_Chess_Losers->_capturePossible() not possible #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'c1');
$board->addPiece('B', 'B', 'c2');
$phpunit->assertFalse($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done