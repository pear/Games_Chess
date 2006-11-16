--TEST--
Games_Chess_Crazyhouse->_validMove() invalid castling (black) 2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->_move = 'B';
$board->_moveAlgebraic('f8', 'e4');
$board->_moveAlgebraic('g8', 'e5');
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertTrue($err, 'O-O should work');
$board->_BCastleK = false;
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle kingside, either the king or rook has moved')
), 2);
$board->_moveAlgebraic('d8', 'e4');
$board->_moveAlgebraic('c8', 'e5');
$board->_moveAlgebraic('b8', 'e3');
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertTrue($err, 'O-O-O should work');
$board->_BCastleQ = false;
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle queenside, either the king or rook has moved')
), 2);
echo 'tests done';
?>
--EXPECT--
tests done