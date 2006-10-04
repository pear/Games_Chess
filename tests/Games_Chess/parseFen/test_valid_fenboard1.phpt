--TEST--
Games_Chess->_parseFen() valid board after parseFen #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$newboard = new Games_Chess_testStandard;
$err = $newboard->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w Qkq d6 5 12');
$phpunit->assertTrue($err, 'not valid parse');
$phpunit->assertEquals(
    array(
        array('B', 'R', 'a8'),
        array('B', 'N', 'b8'),
        array('B', 'B', 'c8'),
        array('B', 'Q', 'd8'),
        array('B', 'K', 'e8'),
        array('B', 'B', 'f8'),
        array('B', 'N', 'g8'),
        array('B', 'R', 'h8'),

        array('B', 'P', 'a7'),
        array('B', 'P', 'b7'),
        array('B', 'P', 'c7'),
        array('B', 'P', 'd7'),
        array('B', 'P', 'e7'),
        array('B', 'P', 'f7'),
        array('B', 'P', 'g7'),
        array('B', 'P', 'h7'),

        array('W', 'P', 'a2'),
        array('W', 'P', 'b2'),
        array('W', 'P', 'c2'),
        array('W', 'P', 'd2'),
        array('W', 'P', 'e2'),
        array('W', 'P', 'f2'),
        array('W', 'P', 'g2'),
        array('W', 'P', 'h2'),

        array('W', 'R', 'a1'),
        array('W', 'N', 'b1'),
        array('W', 'B', 'c1'),
        array('W', 'Q', 'd1'),
        array('W', 'K', 'e1'),
        array('W', 'B', 'f1'),
        array('W', 'N', 'g1'),
        array('W', 'R', 'h1'),
    ),
    $newboard->pieces, 'incorrect board setup');
echo 'tests done';
?>
--EXPECT--
tests done