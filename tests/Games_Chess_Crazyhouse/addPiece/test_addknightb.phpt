--TEST--
Games_Chess_Crazyhouse->addPiece() add black knight
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['B']['N'][0],
    'incorrect knight setup');
$board->addPiece('B', 'N', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['B']['N'][0],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['B']['N'][1],
    'incorrect knight setup');
$board->addPiece('B', 'N', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['B']['N'][0],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['B']['N'][1],
    'second knight changed, should not change');
$phpunit->assertEquals(array('h1','N'), $board->_pieces['B']['P'][0],
    'incorrect knight setup');
echo 'tests done';
?>
--EXPECT--
tests done