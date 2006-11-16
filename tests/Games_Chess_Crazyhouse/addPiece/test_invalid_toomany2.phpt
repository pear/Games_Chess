--TEST--
Games_Chess_Crazyhouse->addPiece() invalid, too many pieces (extended test 2)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'd6');
$phpunit->assertNoErrors('Rd6');
$board->addPiece('B', 'R', 'c5');
$phpunit->assertNoErrors('Rc5');
$board->addPiece('B', 'R', 'c4');
$phpunit->assertNoErrors('Rc4');
$board->addPiece('B', 'R', 'd4');
$phpunit->assertNoErrors('Rd4');
$board->addPiece('B', 'R', 'e4');
$phpunit->assertNoErrors('Re4');
$board->addPiece('B', 'R', 'f4');
$phpunit->assertNoErrors('Rf4');
$board->addPiece('B', 'R', 'g4');
$phpunit->assertNoErrors('Rg4');
$board->addPiece('B', 'R', 'h4');
$phpunit->assertNoErrors('Rh4');
$board->addPiece('B', 'R', 'h2');
$phpunit->assertNoErrors('Rh2');
$board->addPiece('B', 'R', 'h3');
$phpunit->assertNoErrors('Rh3');
$board->addPiece('B', 'R', 'b3');
$phpunit->assertNoErrors('Rb3');
$board->addPiece('B', 'R', 'a3');
$phpunit->assertNoErrors('Rb3');
$board->addPiece('B', 'R', 'c3');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Rooks')
), 'move');
echo 'tests done';
?>
--EXPECT--
tests done