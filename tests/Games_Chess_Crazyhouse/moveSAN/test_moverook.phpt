--TEST--
Games_Chess_Crazyhouse->moveSAN() move rook
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_WCastleQ = $board->_WCastleK = true;
$board->_BCastleQ = $board->_BCastleK = true;
$err = $board->addPiece('W', 'R', 'a1');
$phpunit->assertTrue($err, 'adding W rook 1 failed');
$err = $board->moveSAN('Ra3');
$phpunit->assertTrue($err, 'moving W rook 1 failed');
$phpunit->assertTrue($board->_BCastleQ, 'BQ cleared 1');
$phpunit->assertTrue($board->_BCastleK, 'BK cleared 1');
$phpunit->assertFalse($board->_WCastleQ, 'WQ not cleared 1');
$phpunit->assertTrue($board->_WCastleK, 'WK cleared 1');
$board->_QCastleW = $board->_QCastleB = true;
$board->_KCastleW = $board->_KCastleB = true;
$board->resetGame();
$board->blankBoard();
$err = $board->addPiece('W', 'R', 'h1');
$phpunit->assertTrue($err, 'adding W rook 2 failed');
$err = $board->moveSAN('Rh8');
$phpunit->assertTrue($err, 'moving W rook 2 failed');
$phpunit->assertTrue($board->_BCastleQ, 'BQ cleared 2');
$phpunit->assertTrue($board->_BCastleK, 'BK cleared 2');
$phpunit->assertTrue($board->_WCastleQ, 'WQ cleared 2');
$phpunit->assertFalse($board->_WCastleK, 'WK not cleared 2');

$board->resetGame();
$board->blankBoard();
$board->_move = 'B';
$board->_WCastleQ = $board->_WCastleK = true;
$board->_BCastleQ = $board->_BCastleK = true;
$err = $board->addPiece('B', 'R', 'a8');
$phpunit->assertTrue($err, 'adding B rook 1 failed');
$err = $board->addPiece('B', 'R', 'h8');
$phpunit->assertTrue($err, 'adding B rook 2 failed');
$err = $board->moveSAN('Ra6');
$phpunit->assertTrue($err, 'moving B rook 1 failed');
$phpunit->assertFalse($board->_BCastleQ, 'BQ not cleared 3');
$phpunit->assertTrue($board->_BCastleK, 'BK cleared 3');
$phpunit->assertTrue($board->_WCastleQ, 'WQ cleared 3');
$phpunit->assertTrue($board->_WCastleK, 'WK cleared 3');
$board->_WCastleQ = $board->_WCastleK = true;
$board->_BCastleQ = $board->_BCastleK = true;
$board->_move = 'B';
$err = $board->moveSAN('Rh7');
$phpunit->assertTrue($err, 'moving B rook 2 failed');
$phpunit->assertTrue($board->_BCastleQ, 'BQ cleared 4');
$phpunit->assertFalse($board->_BCastleK, 'BK not cleared 4');
$phpunit->assertTrue($board->_WCastleQ, 'WQ cleared 4');
$phpunit->assertTrue($board->_WCastleK, 'WK cleared 4');
echo 'tests done';
?>
--EXPECT--
tests done