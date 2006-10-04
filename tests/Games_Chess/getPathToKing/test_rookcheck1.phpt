--TEST--
Games_Chess->getPathToKing() rook check 1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'e1');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('e1', 'e4');
$phpunit->assertEquals(array('e3', 'e2', 'e1'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done