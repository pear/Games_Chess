--TEST--
Games_Chess_Losers->_capturePossible() possible #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e1');
$board->addPiece('B', 'B', 'f1');
$phpunit->assertTrue($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done