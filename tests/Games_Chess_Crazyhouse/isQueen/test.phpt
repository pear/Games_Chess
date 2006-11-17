--TEST--
Games_Chess_Crazyhouse->_isQueen()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'Q', 'e1');
$board->addPiece('W', 'Q', 'e2');
$board->addPiece('W', 'R', 'e4');
$board->addPiece('W', 'P', 'e5');
$phpunit->assertTrue($board->_isQueen('WQ0'), 'WQ0');
$phpunit->assertFalse($board->_isQueen('WQ1'), 'WQ1');
$phpunit->assertTrue($board->_isQueen('WP0'), 'WP0');
$phpunit->assertFalse($board->_isQueen('WR0'), 'WR0');
$phpunit->assertFalse($board->_isQueen('WP1'), 'WP1');
echo 'tests done';
?>
--EXPECT--
tests done