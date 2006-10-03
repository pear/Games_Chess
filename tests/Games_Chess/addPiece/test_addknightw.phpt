--TEST--
Games_Chess->addPiece() add white knight
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['WN1'],
    'incorrect knight setup');
$board->addPiece('W', 'N', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['WN1'],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['WN2'],
    'incorrect knight setup');
$board->addPiece('W', 'N', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['WN1'],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['WN2'],
    'second knight changed, should not change');
$phpunit->assertEquals(array('h1', 'N'), $board->_pieces['WP1'], 'last');
echo 'tests done';
?>
--EXPECT--
tests done