--TEST--
Games_Chess_Crazyhouse->_squareToPiece() pawn on board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'a5');
$board->addPiece('W', 'R', 'a6');
$board->addPiece('W', 'R', 'a3');
$phpunit->assertEquals(array('color' => 'W', 'piece' => 'R'),
    $board->_squareToPiece('a3'), 'wrong piece/color');
echo 'tests done';
?>
--EXPECT--
tests done