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

class Games_Chess_TestCase_inCheck extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_inCheck($name)
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
        if (!$this->_methodExists('inCheck')) {
            return;
        }
        $this->assertFalse($this->board->inCheck('W'),
            'should be empty, and is not');
        $this->assertFalse($this->board->inCheck('B'),
            'should be empty, and is not');
    }
    
    function test_valid_starting()
    {
        if (!$this->_methodExists('inCheck')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->assertFalse($this->board->inCheck('W'), 'white in check');
        $this->assertFalse($this->board->inCheck('B'), 'black in check');
    }
    
    function test_valid_other()
    {
        if (!$this->_methodExists('inCheck')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame('8/pppppppp/8/rnbqkbnr/8/RNBQKBNR/PPPPPPPP/8 w KQkq - 0 1');
        $pieces = $this->board->inCheck('W');
        $this->assertEquals(
            'c5',
            $pieces, 'black checking is wrong');
        $pieces = $this->board->inCheck('B');
        $this->assertEquals(
            'c3',
            $pieces, 'white checking is wrong');
    }
    
    function test_valid_doublecheck()
    {
        if (!$this->_methodExists('inCheck')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'B', 'b4');
        $this->board->addPiece('B', 'N', 'd3');
        $this->board->addPiece('W', 'K', 'e1');
        $piece = $this->board->inCheck('W');
        $this->assertEquals(array('d3', 'b4'), $piece, 'wrong attacking pieces');
    }
}

?>
