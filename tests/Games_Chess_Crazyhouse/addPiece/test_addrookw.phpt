--TEST--
Games_Chess_Crazyhouse->addPiece() add white rook
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['W']['R'][0],
    'incorrect knight setup');
$board->addPiece('W', 'R', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['W']['R'][0],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['W']['R'][1],
    'incorrect knight setup');
$board->addPiece('W', 'R', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['W']['R'][0],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['W']['R'][1],
    'second knight changed, should not change');
$phpunit->assertEquals('h1', $board->_pieces['W']['R'][2],
    'incorrect knight setup');
echo 'tests done';
?>
--EXPECT--
tests done