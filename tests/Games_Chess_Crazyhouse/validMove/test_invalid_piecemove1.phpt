--TEST--
Games_Chess_Crazyhouse->_validMove() invalid piece move 1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'e2');
$board->addPiece('W', 'K', 'e1');
$err = $board->_validMove($board->_parseMove('Bxf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square f3')
), 'Bxf3');
$err = $board->_validMove($board->_parseMove('Bxg3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Bxg3"')
), 'Bxg3');

$board->blankBoard();
$board->addPiece('W', 'Q', 'e2');
$err = $board->_validMove($board->_parseMove('Qxf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square f3')
), 'Qxf3');
$err = $board->_validMove($board->_parseMove('Qxg3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Qxg3"')
), 'Qxg3');

$board->blankBoard();
$board->addPiece('W', 'N', 'e2');
$err = $board->_validMove($board->_parseMove('Nxf4'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square f4')
), 'Nxf4');
$err = $board->_validMove($board->_parseMove('Nxf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Nxf3"')
), 'Nxf3');

$board->blankBoard();
$board->addPiece('W', 'R', 'e2');
$err = $board->_validMove($board->_parseMove('Rxe4'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square e4')
), 'Rxe4');
$err = $board->_validMove($board->_parseMove('Rxf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Rxf3"')
), 'Rxf3');

$board->blankBoard();
$board->addPiece('W', 'K', 'e2');
$err = $board->_validMove($board->_parseMove('Kxe3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is no piece on square e3')
), 'Kxe3');
$err = $board->_validMove($board->_parseMove('Kxg3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no White pieces on the board that can do "Kxg3"')
), 'Kxg3');
echo 'tests done';
?>
--EXPECT--
tests done