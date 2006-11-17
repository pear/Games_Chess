--TEST--
Games_Chess_Crazyhouse->addPiece() add white queen
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'Q', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['W']['Q'][0],
    'incorrect knight setup');
$board->addPiece('W', 'Q', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['W']['Q'][0],
    'first knight changed, should not change');
$phpunit->assertEquals(array('g1','Q'), $board->_pieces['W']['P'][0],
    'second queen changed, should not change');
echo 'tests done';
?>
--EXPECT--
tests done