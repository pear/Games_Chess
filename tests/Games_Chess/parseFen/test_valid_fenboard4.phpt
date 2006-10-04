--TEST--
Games_Chess->_parseFen() valid board after parseFen #4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->_parseFen('rnbqkbn1/pppppppp/5r2/8/8/8/PPPPPPPP/RNBQKBNR w Qkq d6 5 12');
$phpunit->assertTrue($err, 'not valid parse');
$phpunit->assertEquals(
    array(
        'WR1' => 'a1',
        'WN1' => 'b1',
        'WB1' => 'c1',
        'WQ' => 'd1',
        'WK' => 'e1',
        'WB2' => 'f1',
        'WN2' => 'g1',
        'WR2' => 'h1',

        'WP1' => array('a2','P'),
        'WP2' => array('b2','P'),
        'WP3' => array('c2','P'),
        'WP4' => array('d2','P'),
        'WP5' => array('e2','P'),
        'WP6' => array('f2','P'),
        'WP7' => array('g2','P'),
        'WP8' => array('h2','P'),

        'BP1' => array('a7','P'),
        'BP2' => array('b7','P'),
        'BP3' => array('c7','P'),
        'BP4' => array('d7','P'),
        'BP5' => array('e7','P'),
        'BP6' => array('f7','P'),
        'BP7' => array('g7','P'),
        'BP8' => array('h7','P'),

        'BR1' => 'a8',
        'BN1' => 'b8',
        'BB1' => 'c8',
        'BQ' => 'd8',
        'BK' => 'e8',
        'BB2' => 'f8',
        'BN2' => 'g8',
        'BR2' => 'f6',
    ),
    $board->_pieces, 'incorrect board setup');
echo 'tests done';
?>
--EXPECT--
tests done