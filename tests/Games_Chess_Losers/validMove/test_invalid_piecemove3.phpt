--TEST--
Games_Chess_Losers->validMove() invalid piece move 3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'd2');
$board->addPiece('W', 'K', 'e1');
$board->addPiece('B', 'Q', 'a5');
$err = $board->_validMove($board->_parseMove('d4'));
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'That move would put the king in check')
), 'error');

echo 'tests done';
?>
--EXPECT--
tests done