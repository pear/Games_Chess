--TEST--
Games_Chess->_squareToPiece() promoted pawn on square
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'a3');
$board->addPiece('W', 'R', 'a1');
$board->addPiece('W', 'R', 'a2');
$phpunit->assertEquals(array('color' => 'W', 'piece' => 'R'),
    $board->_squareToPiece('a3'), 'wrong piece/color');
echo 'tests done';
?>
--EXPECT--
tests done