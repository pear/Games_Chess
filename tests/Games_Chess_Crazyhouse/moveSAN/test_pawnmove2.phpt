--TEST--
Games_Chess_Crazyhouse->moveSAN() pawn move 2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_halfMoves = 6;
$board->_moveNumber = 1;
$board->_move = 'W';
$board->_enPassantSquare = 'e6';
$err = $board->addPiece('W', 'P', 'e2');
$phpunit->assertTrue($err, 'adding pawn failed');
$err = $board->moveSAN('e4');
$phpunit->assertTrue($err, 'moving pawn failed');
$phpunit->assertEquals(1, $board->_halfMoves, 'half moves did not reset');
$phpunit->assertEquals('B', $board->_move, 'move color did not increment');
$phpunit->assertEquals(1, $board->_moveNumber, 'move number changed');
$phpunit->assertEquals('e3', $board->_enPassantSquare, 'en passant not set');
echo 'tests done';
?>
--EXPECT--
tests done