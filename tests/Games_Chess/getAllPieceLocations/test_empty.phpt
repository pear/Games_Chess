--TEST--
Games_Chess->getAllPieceLocations() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals(array(), $board->getPieceLocations('W'), 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done