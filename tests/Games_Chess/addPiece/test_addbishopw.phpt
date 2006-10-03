--TEST--
Games_Chess->addPiece() add white bishop
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['WB1'],
    'incorrect bishop setup');
$board->addPiece('W', 'B', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['WB1'],
    'first bishop changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['WB2'],
    'incorrect bishop setup');
$board->addPiece('W', 'B', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['WB1'],
    'first bishop changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['WB2'],
    'second bishop changed, should not change');
$phpunit->assertEquals(array('h1', 'B'), $board->_pieces['WP1'], 'last');
echo 'tests done';
?>
--EXPECT--
tests done