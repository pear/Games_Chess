--TEST--
Games_Chess->addPiece() add white rook
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['BR1'],
    'incorrect rook setup');
$board->addPiece('B', 'R', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['BR1'],
    'first rook changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['BR2'],
    'incorrect rook setup');
$board->addPiece('B', 'R', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['BR1'],
    'first rook changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['BR2'],
    'second rook changed, should not change');
$phpunit->assertEquals(array('h1', 'R'), $board->_pieces['BP1'], 'last');
echo 'tests done';
?>
--EXPECT--
tests done