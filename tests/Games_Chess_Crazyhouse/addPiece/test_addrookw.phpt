--TEST--
Games_Chess_Crazyhouse->addPiece() add white rook
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['W']['R'][0],
    'incorrect rook setup');
$board->addPiece('W', 'R', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['W']['R'][0],
    'first rook changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['W']['R'][1],
    'incorrect rook setup');
$board->addPiece('W', 'R', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['W']['R'][0],
    'first rook changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['W']['R'][1],
    'second rook changed, should not change');
$phpunit->assertEquals(array('h1','R'), $board->_pieces['W']['P'][0],
    'incorrect rook setup');
echo 'tests done';
?>
--EXPECT--
tests done