--TEST--
Games_Chess_Crazyhouse->_validMove() invalid placement move 1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->blankBoard();
$err = $board->_validMove($board->_parseMove('P@a5'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no captured Black Pawns available to place')
), 'P@a5');
$err = $board->_validMove($board->_parseMove('B@a5'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no captured Black Bishops available to place')
), 'B@a5');
$err = $board->_validMove($board->_parseMove('R@a5'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no captured Black Rooks available to place')
), 'R@a5');
$err = $board->_validMove($board->_parseMove('Q@a5'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no captured Black Queens available to place')
), 'Q@a5');
$err = $board->_validMove($board->_parseMove('N@a5'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no captured Black Knights available to place')
), 'N@a5');
echo 'tests done';
?>
--EXPECT--
tests done