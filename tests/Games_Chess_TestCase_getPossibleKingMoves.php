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

class Games_Chess_TestCase_getPossibleKingMoves extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getPossibleKingMoves($name)
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
    
    function test_invalid1()
    {
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $err = $this->board->getPossibleKingMoves('a1', 'Q');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'no error returned');
        $this->assertEquals('"Q" is not a valid piece color, try W or B',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid2()
    {
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $err = $this->board->getPossibleKingMoves('a9', 'B');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'no error returned');
        $this->assertEquals('"a9" is not a valid square, must be between a1 and h8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_validw1()
    {
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleKingMoves('b1', 'W');
        $this->assertEquals(array(), $err, 'wrong squares');
    }
    
    function test_validw2()
    {
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleKingMoves('b2', 'W');
        $this->assertEquals(array('a3', 'c3', 'b3'),
            $err, 'wrong squares');
    }
    
    function test_validw3()
    {
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleKingMoves('e6', 'W');
        $this->assertEquals(array('d6', 'd7', 'd5', 'f6', 'f7', 'f5', 'e5', 'e7'),
            $err, 'wrong squares');
    }
    
    function test_validb1()
    {
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleKingMoves('b8', 'B');
        $this->assertEquals(array(), $err, 'wrong squares');
    }
    
    function test_validb2()
    {
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleKingMoves('b7', 'B');
        $this->assertEquals(array('a6', 'c6', 'b6'),
            $err, 'wrong squares');
    }
    
    function test_validb3()
    {
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossibleKingMoves('e3', 'B');
        $this->assertEquals(array('d3', 'd4', 'd2', 'f3', 'f4', 'f2', 'e2', 'e4'),
            $err, 'wrong squares');
    }
}

?>
