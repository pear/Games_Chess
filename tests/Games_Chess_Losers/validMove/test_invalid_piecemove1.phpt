--TEST--
Games_Chess_Losers->validMove() invalid piece move 1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'e2');
$err = $board->_validMove($board->_parseMove('Bxf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square f3')
), 'error 1');

$err = $board->_validMove($board->_parseMove('Bxg3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Bxg3"')
), 'error 2');

$board->blankBoard();
$board->addPiece('W', 'Q', 'e2');
$err = $board->_validMove($board->_parseMove('Qxf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square f3')
), 'error 3');

$err = $board->_validMove($board->_parseMove('Qxg3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Qxg3"')
), 'error 4');

$board->blankBoard();
$board->addPiece('W', 'N', 'e2');
$err = $board->_validMove($board->_parseMove('Nxf4'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square f4')
), 'error 5');

$err = $board->_validMove($board->_parseMove('Nxf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Nxf3"')
), 'error 6');

$board->blankBoard();
$board->addPiece('W', 'R', 'e2');
$err = $board->_validMove($board->_parseMove('Rxe4'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square e4')
), 'error 7');

$err = $board->_validMove($board->_parseMove('Rxf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Rxf3"')
), 'error 8');

$board->blankBoard();
$board->addPiece('W', 'K', 'e2');
$err = $board->_validMove($board->_parseMove('Kxe3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square e3')
), 'error 8');

$err = $board->_validMove($board->_parseMove('Kxg3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Kxg3"')
), 'error 8');

echo 'tests done';
?>
--EXPECT--
tests done