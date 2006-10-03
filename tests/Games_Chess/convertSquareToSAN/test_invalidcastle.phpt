--TEST--
Games_Chess->_convertSquareToSAN() invalid king castling moves
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->blankBoard();
$board->_WCastleK = false;
$board->addPiece('W', 'K', 'e1');
$board->addPiece('W', 'R', 'h1');
$err = $board->_convertSquareToSAN('e1', 'g1');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on e1 cannot move to g1')),
'O-O invalid');

$board->blankBoard();
$board->_WCastleQ = false;
$board->addPiece('W', 'K', 'e1');
$board->addPiece('W', 'R', 'a1');
$err = $board->_convertSquareToSAN('e1', 'c1');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on e1 cannot move to c1')),
'O-O-O invalid');

$board->blankBoard();
$board->_WCastleK = true;
$board->addPiece('W', 'K', 'e2');
$board->addPiece('W', 'R', 'h1');
$err = $board->_convertSquareToSAN('e2', 'g1');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on e2 cannot move to g1')),
'O-O invalid 2');

$board->blankBoard();
$board->_WCastleQ = true;
$board->addPiece('W', 'K', 'e2');
$board->addPiece('W', 'R', 'a1');
$err = $board->_convertSquareToSAN('e2', 'c1');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on e2 cannot move to c1')),
'O-O-O invalid');

$board->blankBoard();
$board->_BCastleK = false;
$board->_move = 'B';
$board->addPiece('B', 'K', 'e8');
$board->addPiece('B', 'R', 'h8');
$err = $board->_convertSquareToSAN('e8', 'g8');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on e8 cannot move to g8')),
'B O-O invalid');

$board->blankBoard();
$board->_BCastleQ = false;
$board->_move = 'B';
$board->addPiece('B', 'K', 'e8');
$board->addPiece('B', 'R', 'a8');
$err = $board->_convertSquareToSAN('e8', 'c8');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on e8 cannot move to c8')),
'B O-O-O invalid');

$board->blankBoard();
$board->_BCastleK = true;
$board->_move = 'B';
$board->addPiece('B', 'K', 'e7');
$board->addPiece('B', 'R', 'h8');
$err = $board->_convertSquareToSAN('e7', 'g8');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on e7 cannot move to g8')),
'B O-O invalid 2');

$board->blankBoard();
$board->_BCastleQ = true;
$board->_move = 'B';
$board->addPiece('B', 'K', 'e7');
$board->addPiece('B', 'R', 'a8');
$err = $board->_convertSquareToSAN('e7', 'c8');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The piece on e7 cannot move to c8')),
'B O-O-O invalid 2');

echo 'tests done';
?>
--EXPECT--
tests done