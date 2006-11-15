--TEST--
Games_Chess_Losers->_capturePossible() not possible #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'c1');
$board->addPiece('W', 'B', 'd2');
$phpunit->assertFalse($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done