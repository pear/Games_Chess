--TEST--
Games_Chess->getPathToKing() bishop check 4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'B', 'h1');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('h1', 'e4');
$phpunit->assertEquals(array('f3', 'g2', 'h1'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done