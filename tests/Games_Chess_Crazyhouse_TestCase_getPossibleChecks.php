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

class Games_Chess_Crazyhouse_TestCase_getPossibleChecks extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_Crazyhouse_TestCase_getPossibleChecks($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->board = new Games_Chess_Crazyhouse();
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
                'WR0' => array(),
                'WN0' => array('a3', 'c3'),
                'WB0' => array(),
                'WQ0' => array(),
                'WK0' => array(),
                'WB1' => array(),
                'WN1' => array('f3', 'h3'),
                'WR1' => array(),
                'WP0' => array('a3', 'a4'),
                'WP1' => array('b3', 'b4'),
                'WP2' => array('c3', 'c4'),
                'WP3' => array('d3', 'd4'),
                'WP4' => array('e3', 'e4'),
                'WP5' => array('f3', 'f4'),
                'WP6' => array('g3', 'g4'),
                'WP7' => array('h3', 'h4'),
            ),
            $pieces, 'white moves are not right');
        $pieces = $this->board->_getPossibleChecks('B');
        $this->assertEquals(
            array(
                'BP0' => array('a6', 'a5'),
                'BP1' => array('b6', 'b5'),
                'BP2' => array('c6', 'c5'),
                'BP3' => array('d6', 'd5'),
                'BP4' => array('e6', 'e5'),
                'BP5' => array('f6', 'f5'),
                'BP6' => array('g6', 'g5'),
                'BP7' => array('h6', 'h5'),
                'BR0' => array(),
                'BN0' => array('c6', 'a6'),
                'BB0' => array(),
                'BQ0' => array(),
                'BK0' => array(),
                'BB1' => array(),
                'BN1' => array('h6', 'f6'),
                'BR1' => array(),
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
                'WR0' => array('a4', 'a5'),
                'WN0' => array('a5', 'c5', 'd4', 'c1', 'a1'),
                'WB0' => array('d4', 'e5', 'b4', 'a5'),
                'WQ0' => array('d4', 'd5', 'e4', 'f5', 'c4', 'b5'),
                'WK0' => array('d4', 'f4', 'e4'),
                'WB1' => array('g4', 'h5', 'e4', 'd5'),
                'WN1' => array('e4', 'f5', 'h5', 'h1', 'f1'),
                'WR1' => array('h4', 'h5'),
                'WP0' => array(),
                'WP1' => array(),
                'WP2' => array(),
                'WP3' => array(),
                'WP4' => array(),
                'WP5' => array(),
                'WP6' => array(),
                'WP7' => array(),
            ),
            $pieces, 'white moves are not right');
        $pieces = $this->board->_getPossibleChecks('B');
        $this->assertEquals(
            array(
                'BP0' => array('a6'),
                'BP1' => array('b6'),
                'BP2' => array('c6'),
                'BP3' => array('d6'),
                'BP4' => array('e6'),
                'BP5' => array('f6'),
                'BP6' => array('g6'),
                'BP7' => array('h6'),
                'BR0' => array('a6', 'a4', 'a3'),
                'BN0' => array('d6', 'd4', 'c3', 'a3'),
                'BB0' => array('d6', 'b6', 'd4', 'e3', 'b4', 'a3'),
                'BQ0' => array('d6', 'd4', 'd3', 'e6', 'c6', 'e4', 'f3', 'c4', 'b3'),
                'BK0' => array('d6', 'd4', 'f6', 'f4', 'e4', 'e6'),
                'BB1' => array('g6', 'e6', 'g4', 'h3', 'e4', 'd3'),
                'BN1' => array('e6', 'h3', 'f3', 'e4'),
                'BR1' => array('h6', 'h4', 'h3'),
            ),
            $pieces, 'black moves are not right');
    }
}

?>
