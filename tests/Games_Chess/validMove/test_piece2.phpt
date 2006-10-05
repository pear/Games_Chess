--TEST--
Games_Chess->_validMove() valid piece move #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'a1');
$board->addPiece('W', 'B', 'a2');
$board->addPiece('W', 'B', 'e2');
$err = $board->_validMove($board->_parseMove('Bf3'));
$phpunit->assertTrue($err, 'bishop move did not work');
$board->addPiece('B', 'B', 'f3');
$err = $board->_validMove($board->_parseMove('Bxf3'));
$phpunit->assertTrue($err, 'bishop capture did not work');

$board->blankBoard();
$board->addPiece('W', 'Q', 'a1');
$board->addPiece('W', 'Q', 'a2');
$board->addPiece('W', 'Q', 'e2');
$err = $board->_validMove($board->_parseMove('Qf3'));
$phpunit->assertTrue($err, 'bishop move did not work');
$board->addPiece('B', 'Q', 'f3');
$err = $board->_validMove($board->_parseMove('Qxf3'));
$phpunit->assertTrue($err, 'bishop capture did not work');

$board->blankBoard();
$board->addPiece('W', 'N', 'a1');
$board->addPiece('W', 'N', 'a2');
$board->addPiece('W', 'N', 'e2');
$err = $board->_validMove($board->_parseMove('Nf4'));
$phpunit->assertTrue($err, 'bishop move did not work');
$board->addPiece('B', 'B', 'f4');
$err = $board->_validMove($board->_parseMove('Nxf4'));
$phpunit->assertTrue($err, 'bishop capture did not work');

$board->blankBoard();
$board->addPiece('W', 'R', 'a1');
$board->addPiece('W', 'R', 'a2');
$board->addPiece('W', 'R', 'e2');
$err = $board->_validMove($board->_parseMove('Re3'));
$phpunit->assertTrue($err, 'bishop move did not work');
$board->addPiece('B', 'B', 'e3');
$err = $board->_validMove($board->_parseMove('Rxe3'));
$phpunit->assertTrue($err, 'bishop capture did not work');
echo 'tests done';
?>
--EXPECT--
tests done