--TEST--
Games_Chess_Crazyhouse->addPiece() add black rook
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['B']['R'][0],
    'incorrect rook setup');
$board->addPiece('B', 'R', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['B']['R'][0],
    'first rook changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['B']['R'][1],
    'incorrect rook setup');
$board->addPiece('B', 'R', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['B']['R'][0],
    'first rook changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['B']['R'][1],
    'second rook changed, should not change');
$phpunit->assertEquals(array('h1','R'), $board->_pieces['B']['P'][0],
    'incorrect rook setup');
echo 'tests done';
?>
--EXPECT--
tests done