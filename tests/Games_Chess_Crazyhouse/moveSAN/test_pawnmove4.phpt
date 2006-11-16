--TEST--
Games_Chess_Crazyhouse->moveSAN() pawn move 4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_halfMoves = 6;
$board->_moveNumber = 1;
$board->_move = 'B';
$board->_enPassantSquare = 'e3';
$err = $board->addPiece('W', 'P', 'e4');
$phpunit->assertTrue($err, 'adding W pawn failed');
$err = $board->addPiece('B', 'P', 'd4');
$phpunit->assertTrue($err, 'adding B pawn failed');
$err = $board->moveSAN('dxe3');
$phpunit->assertTrue($err, 'capturing pawn failed');
$phpunit->assertEquals(1, $board->_halfMoves, 'half moves did not reset');
$phpunit->assertEquals('W', $board->_move, 'move color did not increment');
$phpunit->assertEquals(2, $board->_moveNumber, 'move number changed');
$phpunit->assertEquals('-', $board->_enPassantSquare, 'en passant not set');
echo 'tests done';
?>
--EXPECT--
tests done