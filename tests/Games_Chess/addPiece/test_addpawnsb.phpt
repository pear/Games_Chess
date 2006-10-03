--TEST--
Games_Chess->addPiece() add black pawns
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'P', 'a2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['BP1'],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'a3');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['BP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['BP2'],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'b2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['BP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['BP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['BP3'],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'c2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['BP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['BP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['BP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['BP4'],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'd2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['BP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['BP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['BP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['BP4'],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['BP5'],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'e2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['BP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['BP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['BP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['BP4'],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['BP5'],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['BP6'],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'f2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['BP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['BP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['BP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['BP4'],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['BP5'],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['BP6'],
    '6 pawn not the same');
$phpunit->assertEquals(array('f2', 'P'), $board->_pieces['BP7'],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'g2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['BP1'],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['BP2'],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['BP3'],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['BP4'],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['BP5'],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['BP6'],
    '6 pawn not the same');
$phpunit->assertEquals(array('f2', 'P'), $board->_pieces['BP7'],
    '7 pawn not the same');
$phpunit->assertEquals(array('g2', 'P'), $board->_pieces['BP8'],
    'incorrect pawn setup');
echo 'tests done';
?>
--EXPECT--
tests done