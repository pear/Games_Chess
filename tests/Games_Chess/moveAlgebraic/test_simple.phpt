--TEST--
Games_Chess->_moveAlgebraic() simple move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'e4');
$phpunit->assertEquals('e4', $board->_pieces['WB1'], 'setup test 1');
$phpunit->assertEquals('WB1', $board->_board['e4'], 'setup test 2');
$phpunit->assertEquals('h7', $board->_board['h7'], 'setup test 3');
$board->_moveAlgebraic('e4', 'h7');
$phpunit->assertEquals('h7', $board->_pieces['WB1'], 'move test 1');
$phpunit->assertEquals('e4', $board->_board['e4'], 'move test 2');
$phpunit->assertEquals('WB1', $board->_board['h7'], 'move test 3');
echo 'tests done';
?>
--EXPECT--
tests done