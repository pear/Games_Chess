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

class Games_Chess_Losers_TestCase_capturePossible extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_Losers_TestCase_capturePossible($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->board = new Games_Chess_Losers();
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
    
    function test_invalid_w1()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'c1');
        $this->assertFalse($this->board->_capturePossible(), 'nope');
    }
    
    function test_invalid_w2()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'c1');
        $this->board->addPiece('B', 'B', 'c2');
        $this->assertFalse($this->board->_capturePossible(), 'nope');
    }
    
    function test_invalid_w3()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'c1');
        $this->board->addPiece('W', 'B', 'd2');
        $this->assertFalse($this->board->_capturePossible(), 'nope');
    }
    
    function test_valid_w1()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'c1');
        $this->board->addPiece('B', 'B', 'd3');
        $this->assertTrue($this->board->_capturePossible(), 'nope');
    }
    
    function test_valid_w2()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('B', 'B', 'f1');
        $this->assertTrue($this->board->_capturePossible(), 'nope');
    }
    
    function test_invalid_wcastle()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('B', 'B', 'g1');
        $this->assertFalse($this->board->_capturePossible(), 'nope');
    }
    
    function test_invalid_b1()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'B', 'c1');
        $this->assertFalse($this->board->_capturePossible(), 'nope');
    }
    
    function test_invalid_b2()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'B', 'c1');
        $this->board->addPiece('W', 'B', 'c2');
        $this->assertFalse($this->board->_capturePossible(), 'nope');
    }
    
    function test_invalid_b3()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'N', 'c1');
        $this->board->addPiece('B', 'B', 'd2');
        $this->assertFalse($this->board->_capturePossible(), 'nope');
    }
    
    function test_valid_b1()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'N', 'c1');
        $this->board->addPiece('W', 'B', 'd3');
        $this->assertTrue($this->board->_capturePossible(), 'nope');
    }
    
    function test_valid_b2()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'K', 'e1');
        $this->board->addPiece('W', 'B', 'f1');
        $this->assertTrue($this->board->_capturePossible(), 'nope');
    }
    
    function test_invalid_bcastle()
    {
        if (!$this->_methodExists('_capturePossible')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'K', 'e1');
        $this->board->addPiece('W', 'B', 'g1');
        $this->assertFalse($this->board->_capturePossible(), 'nope');
    }
}

?>
