--TEST--
Games_Chess_Losers->validMove() valid castling, black queenside
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('rnbqkbnr/pppppppp/B7/8/8/8/PPPPPPPP/RN1QKBNR w KQkq - 0 1');
$err = $board->_validMove($board->_parseMove('Bxb7'));
$phpunit->assertTrue($err, 'error returned');
$err = $board->_validMove($board->_parseMove('Nf3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Capture is possible, "Nf3" does not capture')
), 'error 1');

$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Capture is possible, "O-O" does not capture')
), 'error 2');

$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Capture is possible, "O-O-O" does not capture')
), 'error 3');

echo 'tests done';
?>
--EXPECT--
tests done