--TEST--
Games_Chess->_validMove() invalid castle move (white) #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle kingside, pieces are in the way'),
), 1);

$board->_moveAlgebraic('f1', 'e4');
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle kingside, pieces are in the way'),
), 2);

$board->_moveAlgebraic('e4', 'f1');
$board->_moveAlgebraic('g1', 'e4');
$err = $board->_validMove($board->_parseMove('O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle kingside, pieces are in the way'),
), 3);

$board->resetGame();
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle queenside, pieces are in the way'),
), 4);

$board->_moveAlgebraic('d1', 'e4');
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle queenside, pieces are in the way'),
), 5);

$board->_moveAlgebraic('c1', 'e5');
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle queenside, pieces are in the way'),
), 5);

$board->_moveAlgebraic('e5', 'c1');
$board->_moveAlgebraic('b1', 'h4');
$err = $board->_validMove($board->_parseMove('O-O-O'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Can\'t castle queenside, pieces are in the way'),
), 5);

echo 'tests done';
?>
--EXPECT--
tests done