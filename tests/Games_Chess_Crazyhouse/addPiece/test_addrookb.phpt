--TEST--
Games_Chess_Crazyhouse->addPiece() add black rook
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['B']['R'][0],
    'incorrect knight setup');
$board->addPiece('B', 'R', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['B']['R'][0],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['B']['R'][1],
    'incorrect knight setup');
$board->addPiece('B', 'R', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['B']['R'][0],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['B']['R'][1],
    'second knight changed, should not change');
$phpunit->assertEquals('h1', $board->_pieces['B']['R'][2],
    'incorrect knight setup');
echo 'tests done';
?>
--EXPECT--
tests done