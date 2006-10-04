--TEST--
Games_Chess->getPathToKing() bishop check 2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'B', 'h7');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('h7', 'e4');
$phpunit->assertEquals(array('f5', 'g6', 'h7'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done