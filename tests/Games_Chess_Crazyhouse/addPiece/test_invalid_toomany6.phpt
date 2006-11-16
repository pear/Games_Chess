--TEST--
Games_Chess_Crazyhouse->addPiece() invalid, too many pieces (extended test 6)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_captured['B']['R']++;
$board->addPiece('W', 'P', 'a2');
$board->addPiece('W', 'P', 'b2');
$board->addPiece('W', 'P', 'c2');
$board->addPiece('W', 'P', 'd2');
$board->addPiece('W', 'P', 'e2');
$board->addPiece('W', 'P', 'f2');
$board->addPiece('W', 'P', 'g2');
$board->addPiece('W', 'P', 'h2');

$board->addPiece('W', 'P', 'a7');
$board->addPiece('W', 'P', 'b7');
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
$phpunit->assertNoErrors('Rd4');
$board->addPiece('B', 'R', 'd5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Rooks')
), 'move');
echo 'tests done';
?>
--EXPECT--
tests done