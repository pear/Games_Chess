--TEST--
Games_Chess->addPiece() add black queen
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'Q', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['BQ'],
    'incorrect queen setup');
$board->addPiece('B', 'Q', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['BQ'],
    'first queen changed, should not change');
$phpunit->assertEquals(array('h1', 'Q'), $board->_pieces['BP1'], 'last');
echo 'tests done';
?>
--EXPECT--
tests done