<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_getRookSquares extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getRookSquares($name)
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
        $this->assertTrue(false, "$errstr at line $errline");
    }
    
    function test_getRookSquares_valid1()
    {
        if (!$this->_methodExists('_getRookSquares')) {
            return;
        }
        $ret = $this->board->_getRookSquares('a1');
        $this->assertEquals(false, $ret['S'], 'South should not exist');
        $this->assertEquals(false, $ret['W'], 'West should not exist');
        $this->assertEquals(array('a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8'),
            $ret['N'], 'North should contain some RookSquares');
        $this->assertEquals(array('b1', 'c1', 'd1', 'e1', 'f1', 'g1', 'h1'),
            $ret['E'], 'East should contain some RookSquares');
    }
    
    function test_getRookSquares_valid2()
    {
        if (!$this->_methodExists('_getRookSquares')) {
            return;
        }
        $ret = $this->board->_getRookSquares('a1', true);
        $this->assertEquals(array('a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8', 'b1',
            'c1', 'd1', 'e1', 'f1', 'g1', 'h1'),
            $ret, 'simple array');
    }
    
    function test_getRookSquares_valid3()
    {
        if (!$this->_methodExists('_getRookSquares')) {
            return;
        }
        $ret = $this->board->_getRookSquares('a8');
        $this->assertEquals(false, $ret['W'], 'West should not exist');
        $this->assertEquals(false, $ret['N'], 'North should not exist');
        $this->assertEquals(array('a7', 'a6', 'a5', 'a4', 'a3', 'a2', 'a1'),
            $ret['S'], 'South should contain some RookSquares');
        $this->assertEquals(array('b8', 'c8', 'd8', 'e8', 'f8', 'g8', 'h8'),
            $ret['E'], 'East should contain some RookSquares');
    }
    
    function test_getRookSquares_valid4()
    {
        if (!$this->_methodExists('_getRookSquares')) {
            return;
        }
        $ret = $this->board->_getRookSquares('h8');
        $this->assertEquals(false, $ret['E'], 'East should not exist');
        $this->assertEquals(false, $ret['N'], 'North should not exist');
        $this->assertEquals(array('h7', 'h6', 'h5', 'h4', 'h3', 'h2', 'h1'),
            $ret['S'], 'South should contain some RookSquares');
        $this->assertEquals(array('g8', 'f8', 'e8', 'd8', 'c8', 'b8', 'a8'),
            $ret['W'], 'West should contain some RookSquares');
    }
    
    function test_getRookSquares_valid5()
    {
        if (!$this->_methodExists('_getRookSquares')) {
            return;
        }
        $ret = $this->board->_getRookSquares('h1');
        $this->assertEquals(false, $ret['E'], 'East should not exist');
        $this->assertEquals(false, $ret['S'], 'South should not exist');
        $this->assertEquals(array('h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8'),
            $ret['N'], 'South should contain some RookSquares');
        $this->assertEquals(array('g1', 'f1', 'e1', 'd1', 'c1', 'b1', 'a1'),
            $ret['W'], 'West should contain some RookSquares');
    }
    
    function test_getRookSquares_valid6()
    {
        if (!$this->_methodExists('_getRookSquares')) {
            return;
        }
        $ret = $this->board->_getRookSquares('e4');
        $this->assertEquals(array('d4', 'c4', 'b4', 'a4'),
            $ret['W'], 'West should should contain some RookSquares');
        $this->assertEquals(array('f4', 'g4', 'h4'),
            $ret['E'], 'East should contain some RookSquares');
        $this->assertEquals(array('e5', 'e6', 'e7', 'e8'),
            $ret['N'], 'North should should contain some RookSquares');
        $this->assertEquals(array('e3', 'e2', 'e1'),
            $ret['S'], 'South should contain some RookSquares');
    }
}

?>
