--TEST--
Games_Chess_Crazyhouse->addPiece() add black quuen
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'Q', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['B']['Q'][0],
    'incorrect queen setup');
$board->addPiece('B', 'Q', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['B']['Q'][0],
    'first queen changed, should not change');
$phpunit->assertEquals(array('g1','Q'), $board->_pieces['B']['P'][0],
    'second queen changed, should not change');
echo 'tests done';
?>
--EXPECT--
tests done