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

class Games_Chess_TestCase_interposeOrCapture extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_interposeOrCapture($name)
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
    
    function test_knightcheck_capture_possible()
    {
        if (!$this->_methodExists('_interposeOrCapture')) {
            return;
        }
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'e4');
        $this->board->addPiece('B', 'N', 'd2');
        $this->board->addPiece('W', 'Q', 'h6');
        $this->assertTrue($this->board->_interposeOrCapture(
            $this->board->_getPathToKing('d2', 'e4'), 'W'));
    }
    
    function test_knightcheck_capture_impossible()
    {
        if (!$this->_methodExists('_interposeOrCapture')) {
            return;
        }
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'e4');
        $this->board->addPiece('B', 'N', 'd2');
        $this->board->addPiece('W', 'Q', 'h5');
        $this->assertFalse($this->board->_interposeOrCapture(
            $this->board->_getPathToKing('d2', 'e4'), 'W'));
    }
    
    function test_piececheck_capture_possible()
    {
        if (!$this->_methodExists('_interposeOrCapture')) {
            return;
        }
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'e4');
        $this->board->addPiece('B', 'B', 'b1');
        $this->board->addPiece('W', 'Q', 'h1');
        $this->assertTrue($this->board->_interposeOrCapture(
            $this->board->_getPathToKing('b1', 'e4'), 'W'));
    }
    
    function test_piececheck_capture_impossible()
    {
        if (!$this->_methodExists('_interposeOrCapture')) {
            return;
        }
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'e4');
        $this->board->addPiece('B', 'N', 'b1');
        $this->board->addPiece('W', 'Q', 'h2');
        $this->assertFalse($this->board->_interposeOrCapture(
            $this->board->_getPathToKing('b1', 'e4'), 'W'));
    }
}

?>
