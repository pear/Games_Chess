--TEST--
Games_Chess_Crazyhouse->addPiece() invalid, too many pieces (extended test 4)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_captured['W']['R']++;
$board->addPiece('B', 'P', 'a7');
$board->addPiece('B', 'P', 'b7');
$board->addPiece('B', 'P', 'c7');
$board->addPiece('B', 'P', 'd7');
$board->addPiece('B', 'P', 'e7');
$board->addPiece('B', 'P', 'f7');
$board->addPiece('B', 'P', 'g7');
$board->addPiece('B', 'P', 'h7');
$board->addPiece('B', 'R', 'd6');
$phpunit->assertNoErrors('Rd6');
$board->addPiece('B', 'R', 'c5');
$phpunit->assertNoErrors('Rc5');
$board->addPiece('B', 'R', 'c4');
$phpunit->assertNoErrors('Rc4');
$board->addPiece('B', 'R', 'd4');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Rooks')
), 'move');
echo 'tests done';
?>
--EXPECT--
tests done