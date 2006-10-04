--TEST--
Games_Chess->getPathToKing() rook check 3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'e8');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('e8', 'e4');
$phpunit->assertEquals(array('e5', 'e6', 'e7', 'e8'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done