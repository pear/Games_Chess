--TEST--
Games_Chess_Losers->_capturePossible() not possible #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'c1');
$phpunit->assertFalse($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done