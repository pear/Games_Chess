--TEST--
Games_Chess_Crazyhouse->moveSAN() piece move 2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_halfMoves = 6;
$board->_moveNumber = 1;
$board->_move = 'B';
$board->_enPassantSquare = 'e3';
$err = $board->addPiece('B', 'N', 'e4');
$phpunit->assertTrue($err, 'adding W knight failed');
$err = $board->moveSAN('Nxf6');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square f6')
), 'error');
$phpunit->assertEquals(6, $board->_halfMoves, 'half moves did not increment');
$phpunit->assertEquals('B', $board->_move, 'move color did not increment');
$phpunit->assertEquals(1, $board->_moveNumber, 'move number changed');
$phpunit->assertEquals('e3', $board->_enPassantSquare, 'en passant not reset');
echo 'tests done';
?>
--EXPECT--
tests done