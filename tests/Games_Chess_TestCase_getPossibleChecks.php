<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

/**
 * @package Games_Chess
 */

class Games_Chess_TestCase_getPossibleChecks extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getPossibleChecks($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->board = new Games_Chess_Standard();
        $this->board->blankBoard();
    }

    function tearDown()
    {
        unset($this->board);
    }

    function _stripWhitespace($str)
    {
        return preg_replace('/\\s+/', '', $str);
    }

    function _methodExists($name) 
    {
        $test = $name;
        if (version_compare(phpversion(), '5.0.0', '<=')) {
            $test = strtolower($name);
        }
        if (in_array($test, get_class_methods($this->board))) {
            return true;
        }
        $this->assertTrue(false, 'method '. $name . ' not implemented in ' . get_class($this->board));
        return false;
    }

    function errorHandler($errno, $errstr, $errfile, $errline) {
        //die("$errstr in $errfile at line $errline: $errstr");
        $this->errorOccured = true;
        $this->assertTrue(false, "$errstr at line $errline, $errfile");
    }
    
    function test_valid_empty()
    {
        if (!$this->_methodExists('_getPossibleChecks')) {
            return;
        }
        $this->assertEquals(array(), $this->board->_getPossibleChecks('W'),
            'should be empty, and is not');
        $this->assertEquals(array(), $this->board->_getPossibleChecks('B'),
            'should be empty, and is not');
    }
    
    function test_valid_starting()
    {
        if (!$this->_methodExists('_getPossibleChecks')) {
            return;
        }
        $this->board->resetGame();
        $pieces = $this->board->_getPossibleChecks('W');
        $this->assertEquals(
            array(
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
            ),
            $pieces, 'white moves are not right');
        $pieces = $this->board->_getPossibleChecks('B');
        $this->assertEquals(
            array(
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
            ),
            $pieces, 'black moves are not right');
    }
    
    function test_valid_other()
    {
        if (!$this->_methodExists('_getPossibleChecks')) {
            return;
        }
        $this->board->resetGame('8/pppppppp/8/rnbqkbnr/8/RNBQKBNR/PPPPPPPP/8 w KQkq - 0 1');
        $pieces = $this->board->_getPossibleChecks('W');
        $this->assertEquals(
            array(
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
            ),
            $pieces, 'white moves are not right');
        $pieces = $this->board->_getPossibleChecks('B');
        $this->assertEquals(
            array(
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
            ),
            $pieces, 'black moves are not right');
    }
}

?>
