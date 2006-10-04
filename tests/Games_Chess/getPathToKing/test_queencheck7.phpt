--TEST--
Games_Chess->getPathToKing() queen check 7
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'Q', 'e8');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('e8', 'e4');
$phpunit->assertEquals(array('e5', 'e6', 'e7', 'e8'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done