<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_getKnightSquares extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getKnightSquares($name)
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
    
    function test_getKnightSquares_valid1()
    {
        if (!$this->_methodExists('_getKnightSquares')) {
            return;
        }
        $ret = $this->board->_getKnightSquares('a1');
        $this->assertEquals('b3',
            $ret['NNE'], 'NNE should contain some KnightSquares');
        $this->assertEquals('c2',
            $ret['ENE'], 'ENE should contain some KnightSquares');
    }
    
    function test_getKnightSquares_valid2()
    {
        if (!$this->_methodExists('_getKnightSquares')) {
            return;
        }
        $ret = $this->board->_getKnightSquares('a1', true);
        $this->assertEquals(array('b3', 'c2'),
            $ret, 'simple array');
    }
    
    function test_getKnightSquares_valid3()
    {
        if (!$this->_methodExists('_getKnightSquares')) {
            return;
        }
        $ret = $this->board->_getKnightSquares('a8');
        $this->assertEquals('c7',
            $ret['ESE'], 'ESE should contain some KnightSquares');
        $this->assertEquals('b6',
            $ret['SSE'], 'SSE should contain some KnightSquares');
    }
    
    function test_getKnightSquares_valid4()
    {
        if (!$this->_methodExists('_getKnightSquares')) {
            return;
        }
        $ret = $this->board->_getKnightSquares('h8');
        $this->assertEquals('f7',
            $ret['WSW'], 'WSW should contain some KnightSquares');
        $this->assertEquals('g6',
            $ret['SSW'], 'SSW should contain some KnightSquares');
    }
    
    function test_getKnightSquares_valid5()
    {
        if (!$this->_methodExists('_getKnightSquares')) {
            return;
        }
        $ret = $this->board->_getKnightSquares('h1');
        $this->assertEquals('f2',
            $ret['WNW'], 'WNW should contain some KnightSquares');
        $this->assertEquals('g3',
            $ret['NNW'], 'NNW should contain some KnightSquares');
    }
    
    function test_getKnightSquares_valid6()
    {
        if (!$this->_methodExists('_getKnightSquares')) {
            return;
        }
        $ret = $this->board->_getKnightSquares('e4');
        $this->assertEquals('c5',
            $ret['WNW'], 'WNW should contain some KnightSquares');
        $this->assertEquals('d6',
            $ret['NNW'], 'NNW should contain some KnightSquares');
        $this->assertEquals('f6',
            $ret['NNE'], 'NNE should contain some KnightSquares');
        $this->assertEquals('g5',
            $ret['ENE'], 'ENE should contain some KnightSquares');
        $this->assertEquals('g3',
            $ret['ESE'], 'ESE should contain some KnightSquares');
        $this->assertEquals('f2',
            $ret['SSE'], 'SSE should contain some KnightSquares');
        $this->assertEquals('d2',
            $ret['SSW'], 'SSW should contain some KnightSquares');
        $this->assertEquals('c3',
            $ret['WSW'], 'WSW should contain some KnightSquares');
    }
}

?>
