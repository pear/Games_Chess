--TEST--
Games_Chess->_squareToPiece() pawn on square
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$phpunit->assertEquals(array('color' => 'W', 'piece' => 'P'),
    $board->_squareToPiece('a2'), 'wrong piece/color');
echo 'tests done';
?>
--EXPECT--
tests done