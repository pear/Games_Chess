--TEST--
Games_Chess_Crazyhouse->_isKnight()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'e1');
$board->addPiece('W', 'N', 'e2');
$board->addPiece('W', 'N', 'e3');
$board->addPiece('W', 'R', 'e4');
$board->addPiece('W', 'P', 'e5');
$phpunit->assertTrue($board->_isKnight('WN0'), 'WN0');
$phpunit->assertTrue($board->_isKnight('WN1'), 'WN1');
$phpunit->assertFalse($board->_isKnight('WN2'), 'WN2');
$phpunit->assertTrue($board->_isKnight('WP0'), 'WP0');
$phpunit->assertFalse($board->_isKnight('WR0'), 'WR0');
$phpunit->assertFalse($board->_isKnight('WP1'), 'WP1');
echo 'tests done';
?>
--EXPECT--
tests done