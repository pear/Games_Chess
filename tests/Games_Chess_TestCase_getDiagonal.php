<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_getDiagonal extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getDiagonal($name)
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
        if (in_array(strtolower($name), get_class_methods($this->board))) {
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
    
    function test_getDiagonals_valid1()
    {
        if (!$this->_methodExists('_getDiagonals')) {
            return;
        }
        $ret = $this->board->_getDiagonals('a1');
        $this->assertEquals(false, $ret['NW'], 'Northwest should not exist');
        $this->assertEquals(false, $ret['SE'], 'Southeast should not exist');
        $this->assertEquals(false, $ret['SW'], 'Southwest should not exist');
        $this->assertEquals(array('b2', 'c3', 'd4', 'e5', 'f6', 'g7', 'h8'),
            $ret['NE'], 'Northeast should contain all the diagonals');
    }
    
    function test_getDiagonals_valid2()
    {
        if (!$this->_methodExists('_getDiagonals')) {
            return;
        }
        $ret = $this->board->_getDiagonals('a1', true);
        $this->assertEquals(array('b2', 'c3', 'd4', 'e5', 'f6', 'g7', 'h8'),
            $ret, 'simple array');
    }
    
    function test_getDiagonals_valid3()
    {
        if (!$this->_methodExists('_getDiagonals')) {
            return;
        }
        $ret = $this->board->_getDiagonals('h8');
        $this->assertEquals(false, $ret['NW'], 'Northwest should not exist');
        $this->assertEquals(false, $ret['SE'], 'Southeast should not exist');
        $this->assertEquals(false, $ret['NE'], 'Northeast should not exist');
        $this->assertEquals(array('g7', 'f6', 'e5', 'd4', 'c3', 'b2', 'a1'),
            $ret['SW'], 'Southwest should contain all the diagonals');
    }
    
    function test_getDiagonals_valid4()
    {
        if (!$this->_methodExists('_getDiagonals')) {
            return;
        }
        $ret = $this->board->_getDiagonals('a8');
        $this->assertEquals(false, $ret['NW'], 'Northwest should not exist');
        $this->assertEquals(false, $ret['SW'], 'Southwest should not exist');
        $this->assertEquals(false, $ret['NE'], 'Northeast should not exist');
        $this->assertEquals(array('b7', 'c6', 'd5', 'e4', 'f3', 'g2', 'h1'),
            $ret['SE'], 'Southeast should contain all the diagonals');
    }
    
    function test_getDiagonals_valid5()
    {
        if (!$this->_methodExists('_getDiagonals')) {
            return;
        }
        $ret = $this->board->_getDiagonals('h1');
        $this->assertEquals(false, $ret['NE'], 'Northwest should not exist');
        $this->assertEquals(false, $ret['SW'], 'Southwest should not exist');
        $this->assertEquals(false, $ret['SE'], 'Southeast should not exist');
        $this->assertEquals(array('g2', 'f3', 'e4', 'd5', 'c6', 'b7', 'a8'),
            $ret['NW'], 'Northeast should contain all the diagonals');
    }
    
    function test_getDiagonals_valid6()
    {
        if (!$this->_methodExists('_getDiagonals')) {
            return;
        }
        $ret = $this->board->_getDiagonals('e4');
        $this->assertEquals(array('d3', 'c2', 'b1'),
            $ret['SW'], 'Southwest should should contain some diagonals');
        $this->assertEquals(array('f3', 'g2', 'h1'),
            $ret['SE'], 'Southeast should contain some diagonals');
        $this->assertEquals(array('d5', 'c6', 'b7', 'a8'),
            $ret['NW'], 'Northwest should should contain some diagonals');
        $this->assertEquals(array('f5', 'g6', 'h7'),
            $ret['NE'], 'Northeast should contain some diagonals');
    }
}

?>
