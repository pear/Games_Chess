--TEST--
Games_Chess->_movePiece() piece move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'e4');
$phpunit->assertEquals('e4', $board->_pieces['WB1'], 'setup test');
$board->_movePiece('e4', 'h7');
$phpunit->assertEquals('h7', $board->_pieces['WB1'], 'move test');
echo 'tests done';
?>
--EXPECT--
tests done