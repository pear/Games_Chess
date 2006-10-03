--TEST--
Games_Chess->addPiece() add white rook
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['WR1'],
    'incorrect rook setup');
$board->addPiece('W', 'R', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['WR1'],
    'first rook changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['WR2'],
    'incorrect rook setup');
$board->addPiece('W', 'R', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['WR1'],
    'first rook changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['WR2'],
    'second rook changed, should not change');
$phpunit->assertEquals(array('h1', 'R'), $board->_pieces['WP1'], 'last');
echo 'tests done';
?>
--EXPECT--
tests done