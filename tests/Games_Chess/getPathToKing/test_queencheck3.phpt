--TEST--
Games_Chess->getPathToKing() queen check 3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'Q', 'b1');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('b1', 'e4');
$phpunit->assertEquals(array('d3', 'c2', 'b1'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done