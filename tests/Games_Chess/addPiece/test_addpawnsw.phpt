--TEST--
Games_Chess->addPiece() add white bishop
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'a2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['WP1'],
    'incorrect pawn setup');
$board->addPiece('W', 'P', 'a3');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['WP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['WP2'],
    'incorrect pawn setup');
$board->addPiece('W', 'P', 'b2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['WP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['WP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['WP3'],
    'incorrect pawn setup');
$board->addPiece('W', 'P', 'c2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['WP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['WP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['WP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['WP4'],
    'incorrect pawn setup');
$board->addPiece('W', 'P', 'd2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['WP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['WP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['WP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['WP4'],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['WP5'],
    'incorrect pawn setup');
$board->addPiece('W', 'P', 'e2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['WP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['WP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['WP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['WP4'],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['WP5'],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['WP6'],
    'incorrect pawn setup');
$board->addPiece('W', 'P', 'f2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['WP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['WP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['WP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['WP4'],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['WP5'],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['WP6'],
    '6 pawn not the same');
$phpunit->assertEquals(array('f2', 'P'), $board->_pieces['WP7'],
    'incorrect pawn setup');
$board->addPiece('W', 'P', 'g2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['WP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['WP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['WP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['WP4'],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['WP5'],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['WP6'],
    '6 pawn not the same');
$phpunit->assertEquals(array('f2', 'P'), $board->_pieces['WP7'],
    '7 pawn not the same');
$phpunit->assertEquals(array('g2', 'P'), $board->_pieces['WP8'],
    'incorrect pawn setup');
echo 'tests done';
?>
--EXPECT--
tests done