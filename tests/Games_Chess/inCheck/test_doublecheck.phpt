--TEST--
Games_Chess->inCheck() in double check
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'B', 'b4');
$board->addPiece('B', 'N', 'd3');
$board->addPiece('W', 'K', 'e1');
$piece = $board->inCheck('W');
$phpunit->assertEquals(array('d3', 'b4'), $piece, 'wrong attacking pieces');
echo 'tests done';
?>
--EXPECT--
tests done