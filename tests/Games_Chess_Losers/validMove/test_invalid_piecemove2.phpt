--TEST--
Games_Chess_Losers->validMove() invalid piece move 2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'e2');
$board->addPiece('W', 'K', 'e1');
$board->addPiece('B', 'Q', 'a5');
$err = $board->_validMove($board->_parseMove('e3'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'The move does not remove the check on the king')
), 'error');

echo 'tests done';
?>
--EXPECT--
tests done