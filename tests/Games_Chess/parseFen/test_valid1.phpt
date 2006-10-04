--TEST--
Games_Chess->_parseFen() valid #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQk d3 0 1');
$phpunit->assertSame(true, $err, 'not valid parse');
$phpunit->assertTrue($board->_WCastleQ, '_WCastleQ');
$phpunit->assertTrue($board->_WCastleK, '_WCastleK');
$phpunit->assertFalse(false, $board->_BCastleQ, '_BCastleQ');
$phpunit->assertTrue($board->_BCastleK, '_BCastleK');
$phpunit->assertEquals('B', $board->_move, 'move');
$phpunit->assertEquals('d3', $board->_enPassantSquare, 'wrong en passant');
$phpunit->assertEquals('0', $board->_halfMoves, 'wrong ply count');
$phpunit->assertEquals('1', $board->_moveNumber, 'wrong ply count');
echo 'tests done';
?>
--EXPECT--
tests done