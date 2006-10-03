--TEST--
Games_Chess->addPiece() add white queen
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'Q', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['WQ'],
    'incorrect queen setup');
$board->addPiece('W', 'Q', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['WQ'],
    'first queen changed, should not change');
$phpunit->assertEquals(array('h1', 'Q'), $board->_pieces['WP1'], 'last');
echo 'tests done';
?>
--EXPECT--
tests done