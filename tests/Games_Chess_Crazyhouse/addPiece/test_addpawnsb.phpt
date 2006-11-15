--TEST--
Games_Chess_Crazyhouse->addPiece() add black pawns
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'P', 'a2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'a3');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['B']['P'][1],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'b2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['B']['P'][1],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['B']['P'][2],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'c2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['B']['P'][1],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['B']['P'][2],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['B']['P'][3],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'd2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['B']['P'][1],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['B']['P'][2],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['B']['P'][3],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['B']['P'][4],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'e2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['B']['P'][1],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['B']['P'][2],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['B']['P'][3],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['B']['P'][4],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['B']['P'][5],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'f2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['B']['P'][1],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['B']['P'][2],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['B']['P'][3],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['B']['P'][4],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['B']['P'][5],
    '6 pawn not the same');
$phpunit->assertEquals(array('f2', 'P'), $board->_pieces['B']['P'][6],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'g2');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['B']['P'][1],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['B']['P'][2],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['B']['P'][3],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['B']['P'][4],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['B']['P'][5],
    '6 pawn not the same');
$phpunit->assertEquals(array('f2', 'P'), $board->_pieces['B']['P'][6],
    '7 pawn not the same');
$phpunit->assertEquals(array('g2', 'P'), $board->_pieces['B']['P'][7],
    'incorrect pawn setup');
$board->addPiece('B', 'P', 'g3');
$phpunit->assertEquals(array('a2', 'P'), $board->_pieces['B']['P'][0],
    '1 pawn not the same');
$phpunit->assertEquals(array('a3', 'P'), $board->_pieces['B']['P'][1],
    '2 pawn not the same');
$phpunit->assertEquals(array('b2', 'P'), $board->_pieces['B']['P'][2],
    '3 pawn not the same');
$phpunit->assertEquals(array('c2', 'P'), $board->_pieces['B']['P'][3],
    '4 pawn not the same');
$phpunit->assertEquals(array('d2', 'P'), $board->_pieces['B']['P'][4],
    '5 pawn not the same');
$phpunit->assertEquals(array('e2', 'P'), $board->_pieces['B']['P'][5],
    '6 pawn not the same');
$phpunit->assertEquals(array('f2', 'P'), $board->_pieces['B']['P'][6],
    '7 pawn not the same');
$phpunit->assertEquals(array('g2', 'P'), $board->_pieces['B']['P'][7],
    '8 pawn not the same');
$phpunit->assertEquals(array('g3', 'P'), $board->_pieces['B']['P'][8],
    'incorrect pawn setup');
echo 'tests done';
?>
--EXPECT--
tests done