--TEST--
Games_Chess->_getPossibleChecks() starting position
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('8/pppppppp/8/rnbqkbnr/8/RNBQKBNR/PPPPPPPP/8 w KQkq - 0 1');
$err = $board->_getPossibleChecks('W');
$phpunit->assertEquals(array(
                'WR1' => array('a4', 'a5'),
                'WN1' => array('a5', 'c5', 'd4', 'c1', 'a1'),
                'WB1' => array('d4', 'e5', 'b4', 'a5'),
                'WQ' => array('d4', 'd5', 'e4', 'f5', 'c4', 'b5'),
                'WK' => array('d4', 'f4', 'e4'),
                'WB2' => array('g4', 'h5', 'e4', 'd5'),
                'WN2' => array('e4', 'f5', 'h5', 'h1', 'f1'),
                'WR2' => array('h4', 'h5'),
                'WP1' => array(),
                'WP2' => array(),
                'WP3' => array(),
                'WP4' => array(),
                'WP5' => array(),
                'WP6' => array(),
                'WP7' => array(),
                'WP8' => array(),
            ), $err, 'W');
$err = $board->_getPossibleChecks('B');
$phpunit->assertEquals(array(
                'BP1' => array('a6'),
                'BP2' => array('b6'),
                'BP3' => array('c6'),
                'BP4' => array('d6'),
                'BP5' => array('e6'),
                'BP6' => array('f6'),
                'BP7' => array('g6'),
                'BP8' => array('h6'),
                'BR1' => array('a6', 'a4', 'a3'),
                'BN1' => array('d6', 'd4', 'c3', 'a3'),
                'BB1' => array('d6', 'b6', 'd4', 'e3', 'b4', 'a3'),
                'BQ' => array('d6', 'd4', 'd3', 'e6', 'c6', 'e4', 'f3', 'c4', 'b3'),
                'BK' => array('d6', 'd4', 'f6', 'f4', 'e4', 'e6'),
                'BB2' => array('g6', 'e6', 'g4', 'h3', 'e4', 'd3'),
                'BN2' => array('e6', 'h3', 'f3', 'e4'),
                'BR2' => array('h6', 'h4', 'h3'),
            ), $err, 'B');
echo 'tests done';
?>
--EXPECT--
tests done