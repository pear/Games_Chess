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

class Games_Chess_TestCase_getDiagonalColor extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getDiagonalColor($name)
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
        if (version_compare(phpversion(), '4.3.7', '<=')) {
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
    
    function test_color()
    {
        // pieces would be able to move, but are pinned by check
        if (!$this->_methodExists('_getDiagonalColor')) {
            return;
        }
        $this->assertEquals('B', $this->board->_getDiagonalColor('a1'), 'a1');
        $this->assertEquals('W', $this->board->_getDiagonalColor('b1'), 'b1');
        $this->assertEquals('B', $this->board->_getDiagonalColor('c1'), 'c1');
        $this->assertEquals('W', $this->board->_getDiagonalColor('a2'), 'a2');
        $this->assertEquals('B', $this->board->_getDiagonalColor('b2'), 'b2');
        $this->assertEquals('W', $this->board->_getDiagonalColor('c2'), 'c2');
        $this->assertEquals('B', $this->board->_getDiagonalColor('a3'), 'a3');
        $this->assertEquals('W', $this->board->_getDiagonalColor('b3'), 'b3');
        $this->assertEquals('B', $this->board->_getDiagonalColor('c3'), 'c3');
        $this->assertEquals('W', $this->board->_getDiagonalColor('d3'), 'd3');
        $this->assertEquals('B', $this->board->_getDiagonalColor('e3'), 'e3');
        $this->assertEquals('W', $this->board->_getDiagonalColor('f3'), 'f3');
        $this->assertEquals('B', $this->board->_getDiagonalColor('g3'), 'g3');
        $this->assertEquals('W', $this->board->_getDiagonalColor('h3'), 'h3');
    }
}

?>
