--TEST--
Games_Chess->addPiece() add black knight
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'a1');
$phpunit->assertEquals('a1', $board->_pieces['BN1'],
    'incorrect knight setup');
$board->addPiece('B', 'N', 'g1');
$phpunit->assertEquals('a1', $board->_pieces['BN1'],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['BN2'],
    'incorrect knight setup');
$board->addPiece('B', 'N', 'h1');
$phpunit->assertEquals('a1', $board->_pieces['BN1'],
    'first knight changed, should not change');
$phpunit->assertEquals('g1', $board->_pieces['BN2'],
    'second knight changed, should not change');
$phpunit->assertEquals(array('h1', 'N'), $board->_pieces['BP1'], 'last');
echo 'tests done';
?>
--EXPECT--
tests done