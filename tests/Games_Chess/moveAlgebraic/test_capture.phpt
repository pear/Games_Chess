--TEST--
Games_Chess->_moveAlgebraic() capture
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'e4');
$board->addPiece('B', 'B', 'h7');
$phpunit->assertEquals('e4', $board->_pieces['WB1'], 'setup test 1');
$phpunit->assertEquals('WB1', $board->_board['e4'], 'setup test 2');
$phpunit->assertEquals('BB1', $board->_board['h7'], 'setup test 3');
$phpunit->assertEquals('h7', $board->_pieces['BB1'], 'setup test 4');
$board->_moveAlgebraic('e4', 'h7');
$phpunit->assertEquals('h7', $board->_pieces['WB1'], 'move test 1');
$phpunit->assertEquals('e4', $board->_board['e4'], 'move test 2');
$phpunit->assertEquals('WB1', $board->_board['h7'], 'move test 3');
$phpunit->assertFalse($board->_pieces['BB1'], 'move test 4');
echo 'tests done';
?>
--EXPECT--
tests done