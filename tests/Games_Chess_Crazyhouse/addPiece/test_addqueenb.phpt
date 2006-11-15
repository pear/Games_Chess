--TEST--
Games_Chess_Crazyhouse->addPiece() add black quuen
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'Q', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['B']['Q'][0],
    'incorrect knight setup');
$board->addPiece('B', 'Q', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['B']['Q'][0],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['B']['Q'][1],
    'incorrect knight setup');
$board->addPiece('B', 'Q', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['B']['Q'][0],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['B']['Q'][1],
    'second knight changed, should not change');
$phpunit->assertEquals('h1', $board->_pieces['B']['Q'][2],
    'incorrect knight setup');
echo 'tests done';
?>
--EXPECT--
tests done