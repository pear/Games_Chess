--TEST--
Games_Chess_Crazyhouse->_validMove() invalid castling (white) 2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->_moveAlgebraic('f1', 'e4');
$board->_moveAlgebraic('g1', 'e5');
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertTrue($err, 'O-O should work');
$board->_WCastleK = false;
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle kingside, either the king or rook has moved')
), 2);
$board->_moveAlgebraic('d1', 'e4');
$board->_moveAlgebraic('c1', 'e5');
$board->_moveAlgebraic('b1', 'e3');
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertTrue($err, 'O-O-O should work');
$board->_WCastleQ = false;
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle queenside, either the king or rook has moved')
), 2);
echo 'tests done';
?>
--EXPECT--
tests done