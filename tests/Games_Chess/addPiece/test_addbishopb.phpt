--TEST--
Games_Chess->addPiece() add black bishop
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'B', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['BB1'],
    'incorrect bishop setup');
$board->addPiece('B', 'B', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['BB1'],
    'first bishop changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['BB2'],
    'incorrect bishop setup');
$board->addPiece('B', 'B', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['BB1'],
    'first bishop changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['BB2'],
    'second bishop changed, should not change');
$phpunit->assertEquals(array('h1', 'B'), $board->_pieces['BP1'], 'last');
echo 'tests done';
?>
--EXPECT--
tests done