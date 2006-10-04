--TEST--
Games_Chess->_getPossibleChecks() starting position
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->_getPossibleChecks('W');
$phpunit->assertEquals(array(
                'WR1' => array(),
                'WN1' => array('a3', 'c3'),
                'WB1' => array(),
                'WQ' => array(),
                'WK' => array(),
                'WB2' => array(),
                'WN2' => array('f3', 'h3'),
                'WR2' => array(),
                'WP1' => array('a3', 'a4'),
                'WP2' => array('b3', 'b4'),
                'WP3' => array('c3', 'c4'),
                'WP4' => array('d3', 'd4'),
                'WP5' => array('e3', 'e4'),
                'WP6' => array('f3', 'f4'),
                'WP7' => array('g3', 'g4'),
                'WP8' => array('h3', 'h4'),
            ), $err, 'W');
$err = $board->_getPossibleChecks('B');
$phpunit->assertEquals(array(
                'BP1' => array('a6', 'a5'),
                'BP2' => array('b6', 'b5'),
                'BP3' => array('c6', 'c5'),
                'BP4' => array('d6', 'd5'),
                'BP5' => array('e6', 'e5'),
                'BP6' => array('f6', 'f5'),
                'BP7' => array('g6', 'g5'),
                'BP8' => array('h6', 'h5'),
                'BR1' => array(),
                'BN1' => array('c6', 'a6'),
                'BB1' => array(),
                'BQ' => array(),
                'BK' => array(),
                'BB2' => array(),
                'BN2' => array('h6', 'f6'),
                'BR2' => array(),
            ), $err, 'B');
echo 'tests done';
?>
--EXPECT--
tests done