--TEST--
Games_Chess->getPathToKing() queen check 1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'Q', 'a8');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('a8', 'e4');
$phpunit->assertEquals(array('d5', 'c6', 'b7', 'a8'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done