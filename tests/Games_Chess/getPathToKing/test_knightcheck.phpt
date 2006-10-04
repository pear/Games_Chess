--TEST--
Games_Chess->getPathToKing() knight check
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'd3');
$board->addPiece('W', 'K', 'e1');
$err = $board->_getPathToKing('d3', 'e1');
$phpunit->assertEquals(array('d3'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done