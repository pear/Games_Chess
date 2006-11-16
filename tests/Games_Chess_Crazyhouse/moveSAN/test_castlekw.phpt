--TEST--
Games_Chess_Crazyhouse->moveSAN() kingside castling (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_WCastleQ = $board->_WCastleK = true;
$board->_BCastleQ = $board->_BCastleK = true;
$board->_halfMoves = 6;
$board->_moveNumber = 1;
$board->_enPassantSquare = 'e3';
$err = $board->addPiece('W', 'R', 'h1');
$phpunit->assertTrue($err, 'adding W rook failed');
$err = $board->addPiece('W', 'K', 'e1');
$phpunit->assertTrue($err, 'adding W king failed');
$err = $board->moveSAN('O-O');
$phpunit->assertTrue($err, 'castling kingside failed');
if (is_object($err)) {
    $phpunit->assertEquals($err->message,'');
}
$phpunit->assertTrue($board->_BCastleQ, 'BQ cleared');
$phpunit->assertTrue($board->_BCastleK, 'BK cleared');
$phpunit->assertFalse($board->_WCastleQ, 'WQ not cleared');
$phpunit->assertFalse($board->_WCastleK, 'WK not cleared');
$phpunit->assertEquals(7, $board->_halfMoves, 'half moves did not increment');
$phpunit->assertEquals('B', $board->_move, 'move color did not increment');
$phpunit->assertEquals(1, $board->_moveNumber, 'move number changed');
$phpunit->assertEquals('-', $board->_enPassantSquare, 'en passant not reset');
echo 'tests done';
?>
--EXPECT--
tests done