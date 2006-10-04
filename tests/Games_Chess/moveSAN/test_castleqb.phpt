--TEST--
Games_Chess->moveSAN() castling queenside (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_WCastleQ = $board->_WCastleK = true;
$board->_BCastleQ = $board->_BCastleK = true;
$board->_halfMoves = 6;
$board->_moveNumber = 1;
$board->_enPassantSquare = 'e3';
$board->_move = 'B';
$err = $board->addPiece('B', 'R', 'a8');
$phpunit->assertFalse(is_object($err), 'adding B rook failed');
$err = $board->addPiece('B', 'K', 'e8');
$phpunit->assertFalse(is_object($err), 'adding B king failed');
$err = $board->moveSAN('O-O-O');
$phpunit->assertFalse(is_object($err), 'castling kingside failed');
if (is_object($err)) {
    $phpunit->assertEquals($err->message,'');
}
$phpunit->assertTrue($board->_WCastleQ, 'WQ cleared');
$phpunit->assertTrue($board->_WCastleK, 'WK cleared');
$phpunit->assertFalse($board->_BCastleQ, 'BQ not cleared');
$phpunit->assertFalse($board->_BCastleK, 'BK not cleared');
$phpunit->assertEquals(7, $board->_halfMoves, 'half moves did not increment');
$phpunit->assertEquals('W', $board->_move, 'move color did not increment');
$phpunit->assertEquals(2, $board->_moveNumber, 'move number changed');
$phpunit->assertEquals('-', $board->_enPassantSquare, 'en passant not reset');
echo 'tests done';
?>
--EXPECT--
tests done