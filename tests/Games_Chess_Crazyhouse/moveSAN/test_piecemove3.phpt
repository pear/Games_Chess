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
$phpunit->assertTrue($err, 'adding B knight failed');
$err = $board->addPiece('W', 'N', 'f6');
$phpunit->assertTrue($err, 'adding w knight failed');
$err = $board->moveSAN('Nxf6');
$phpunit->assertTrue($err, 'capturing knight failed');
$phpunit->assertEquals(1, $board->_halfMoves, 'half moves did not reset');
$phpunit->assertEquals('W', $board->_move, 'move color did not increment');
$phpunit->assertEquals(2, $board->_moveNumber, 'move number changed');
$phpunit->assertEquals('-', $board->_enPassantSquare, 'en passant not reset');
echo 'tests done';
?>
--EXPECT--
tests done