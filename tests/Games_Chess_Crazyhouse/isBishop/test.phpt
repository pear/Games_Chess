--TEST--
Games_Chess_Crazyhouse->isBishop()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'e1');
$board->addPiece('W', 'B', 'e2');
$board->addPiece('W', 'B', 'e3');
$board->addPiece('W', 'R', 'e4');
$board->addPiece('W', 'P', 'e5');
$phpunit->assertTrue($board->isBishop('WB0'), 'WB0');
$phpunit->assertTrue($board->isBishop('WB1'), 'WB1');
$phpunit->assertFalse($board->isBishop('WB2'), 'WB2');
$phpunit->assertTrue($board->isBishop('WP0'), 'WP0');
$phpunit->assertFalse($board->isBishop('WR0'), 'WR0');
$phpunit->assertFalse($board->isBishop('WP1'), 'WP1');
echo 'tests done';
?>
--EXPECT--
tests done