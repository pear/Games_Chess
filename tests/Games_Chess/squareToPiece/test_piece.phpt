--TEST--
Games_Chess->_squareToPiece() piece on square
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$phpunit->assertEquals(array('color' => 'W', 'piece' => 'R'),
    $board->_squareToPiece('a1'), 'wrong piece/color');
echo 'tests done';
?>
--EXPECT--
tests done