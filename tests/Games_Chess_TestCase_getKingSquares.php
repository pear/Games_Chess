<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_getKingSquares extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getKingSquares($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->board = new Games_Chess_Standard();
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
        $this->assertTrue(false, "$errstr at line $errline");
    }
    
    function test_getKingSquares_valid1()
    {
        if (!$this->_methodExists('_getKingSquares')) {
            return;
        }
        $ret = $this->board->_getKingSquares('a1');
        $this->assertEquals(array('b1', 'b2', 'a2'),
            $ret, 'Incorrect king squares');
    }
    
    function test_getKingSquares_valid3()
    {
        if (!$this->_methodExists('_getKingSquares')) {
            return;
        }
        $ret = $this->board->_getKingSquares('a8');
        $this->assertEquals(array('b8', 'b7', 'a7'),
            $ret, 'Incorrect king squares');
    }
    
    function test_getKingSquares_valid4()
    {
        if (!$this->_methodExists('_getKingSquares')) {
            return;
        }
        $ret = $this->board->_getKingSquares('h8');
        $this->assertEquals(array('g8', 'g7', 'h7'),
            $ret, 'Incorrect king squares');
    }
    
    function test_getKingSquares_valid5()
    {
        if (!$this->_methodExists('_getKingSquares')) {
            return;
        }
        $ret = $this->board->_getKingSquares('h1');
        $this->assertEquals(array('g1', 'g2', 'h2'),
            $ret, 'Incorrect king squares');
    }
    
    function test_getKingSquares_valid6()
    {
        if (!$this->_methodExists('_getKingSquares')) {
            return;
        }
        $ret = $this->board->_getKingSquares('e4');
        $this->assertEquals(array('d4', 'd5', 'd3', 'f4', 'f5', 'f3', 'e3', 'e5'),
            $ret, 'Incorrect king squares');
    }
}

?>
