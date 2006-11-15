--TEST--
Games_Chess_Losers->_capturePossible() possible #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'c1');
$board->addPiece('B', 'B', 'd3');
$phpunit->assertTrue($board->_capturePossible(), 'nope');
echo 'tests done';
?>
--EXPECT--
tests done