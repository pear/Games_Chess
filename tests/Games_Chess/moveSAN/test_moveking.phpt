--TEST--
Games_Chess->moveSAN() move king
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_WCastleQ = $board->_WCastleK = true;
$board->_BCastleQ = $board->_BCastleK = true;
$err = $board->addPiece('W', 'K', 'e1');
$phpunit->assertFalse(is_object($err), 'adding W king failed');
$err = $board->addPiece('B', 'K', 'e8');
$phpunit->assertFalse(is_object($err), 'adding B king failed');
$err = $board->moveSAN('Ke2');
$phpunit->assertFalse(is_object($err), 'moving W king failed');
$phpunit->assertTrue($board->_BCastleQ, 'BQ cleared');
$phpunit->assertTrue($board->_BCastleK, 'BK cleared');
$phpunit->assertFalse($board->_WCastleQ, 'WQ not cleared');
$phpunit->assertFalse($board->_WCastleK, 'WK not cleared');
$board->_WCastleQ = $board->_WCastleK = true;
$err = $board->moveSAN('Ke7');
$phpunit->assertFalse(is_object($err), 'moving B king failed');
$phpunit->assertFalse($board->_BCastleQ, 'BQ not cleared');
$phpunit->assertFalse($board->_BCastleK, 'BK not cleared');
$phpunit->assertTrue($board->_WCastleQ, 'WQ cleared');
$phpunit->assertTrue($board->_WCastleK, 'WK cleared');
echo 'tests done';
?>
--EXPECT--
tests done