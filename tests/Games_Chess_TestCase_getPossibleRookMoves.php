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

class Games_Chess_TestCase_getPossibleRookMoves extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getPossibleRookMoves($name)
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
        if (in_array(strtolower($name), get_class_methods($this->board))) {
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
    
    function test_invalid1()
    {
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $err = $this->board->getPossibleRookMoves('a1', 'Q');
        $this->assertEquals('pear_error', get_class($err), 'no error returned');
        $this->assertEquals('"Q" is not a valid piece color, try W or B',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid2()
    {
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $err = $this->board->getPossibleRookMoves('a9', 'B');
        $this->assertEquals('pear_error', get_class($err), 'no error returned');
        $this->assertEquals('"a9" is not a valid square, must be between a1 and h8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_validw1()
    {
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleRookMoves('b1', 'W');
        $this->assertEquals(array(), $err, 'wrong squares');
    }
    
    function test_validw2()
    {
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleRookMoves('b2', 'W');
        $this->assertEquals(array('b3', 'b4', 'b5', 'b6', 'b7'),
            $err, 'wrong squares');
    }
    
    function test_validw3()
    {
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleRookMoves('e4', 'W');
        $this->assertEquals(array('e5', 'e6', 'e7', 'f4', 'g4', 'h4',
            'e3', 'd4', 'c4', 'b4', 'a4'), $err, 'wrong squares');
    }
    
    function test_validb1()
    {
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleRookMoves('b8', 'B');
        $this->assertEquals(array(), $err, 'wrong squares');
    }
    
    function test_validb2()
    {
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleRookMoves('b7', 'B');
        $this->assertEquals(array('b6', 'b5', 'b4', 'b3', 'b2'),
            $err, 'wrong squares');
    }
    
    function test_validb3()
    {
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleRookMoves('e4', 'B');
        $this->assertEquals(array('e5', 'e6', 'f4', 'g4', 'h4', 'e3', 'e2', 'd4', 'c4', 'b4', 'a4'),
            $err, 'wrong squares');
    }
}

?>
