--TEST--
Games_Chess->moveSAN() invalid pawn move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_halfMoves = 6;
$board->_moveNumber = 1;
$board->_move = 'W';
$err = $board->addPiece('W', 'P', 'e4');
$phpunit->assertFalse(is_object($err), 'adding W pawn failed');
$err = $board->moveSAN('exd5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "exd5"')
), 'wrong message');
$phpunit->assertEquals(6, $board->_halfMoves, 'half moves did not reset');
$phpunit->assertEquals('W', $board->_move, 'move color did not increment');
$phpunit->assertEquals(1, $board->_moveNumber, 'move number changed');
$phpunit->assertEquals('-', $board->_enPassantSquare, 'en passant not set');
echo 'tests done';
?>
--EXPECT--
tests done