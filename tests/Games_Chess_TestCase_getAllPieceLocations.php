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

class Games_Chess_TestCase_getAllPieceLocations extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getAllPieceLocations($name)
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
    
    function test_invalid1()
    {
        if (!$this->_methodExists('getPieceLocations')) {
            return;
        }
        $err = $this->board->getPieceLocations('White');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'no error returned');
        $this->assertEquals('"WHITE" is not a valid piece color, try W or B',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_valid_empty()
    {
        if (!$this->_methodExists('getPieceLocations')) {
            return;
        }
        $err = $this->board->getPieceLocations('W');
        $this->assertEquals(
            array(
            ),
            $err, 'wrong squares');
    }
    
    function test_validw()
    {
        if (!$this->_methodExists('getPieceLocations')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPieceLocations('W');
        $this->assertEquals(
            array(
                'a1', 'b1', 'c1', 'd1', 'e1', 'f1', 'g1', 'h1',
                'a2', 'b2', 'c2', 'd2', 'e2', 'f2', 'g2', 'h2'
            ),
            $err, 'wrong squares');
    }
    
    function test_validb()
    {
        if (!$this->_methodExists('getPieceLocations')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPieceLocations('B');
        $this->assertEquals(
            array(
                'a7', 'b7', 'c7', 'd7', 'e7', 'f7', 'g7', 'h7',
                'a8', 'b8', 'c8', 'd8', 'e8', 'f8', 'g8', 'h8',
            ),
            $err, 'wrong squares');
    }
}

?>
