--TEST--
Games_Chess->getPathToKing() queen check 6
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'Q', 'a4');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('a4', 'e4');
$phpunit->assertEquals(array('d4', 'c4', 'b4', 'a4'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done