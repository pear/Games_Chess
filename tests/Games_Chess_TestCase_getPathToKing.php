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

class Games_Chess_TestCase_getPathToKing extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getPathToKing($name)
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
    
    function test_knightcheck()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'N', 'd3');
        $this->board->addPiece('W', 'K', 'e1');
        $err = $this->board->_getPathToKing('d3', 'e1');
        $this->assertEquals(array('d3'), $err, 'wrong squares');
    }
    
    function test_pawncheck1()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'P', 'd2');
        $this->board->addPiece('W', 'K', 'e1');
        $err = $this->board->_getPathToKing('d2', 'e1');
        $this->assertEquals(array('d2'), $err, 'wrong squares');
    }
    
    function test_pawncheck2()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'P', 'f2');
        $this->board->addPiece('W', 'K', 'e1');
        $err = $this->board->_getPathToKing('f2', 'e1');
        $this->assertEquals(array('f2'), $err, 'wrong squares');
    }
    
    function test_bishopcheck1()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'B', 'a8');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('a8', 'e4');
        $this->assertEquals(array('d5', 'c6', 'b7', 'a8'), $err, 'wrong squares');
    }
    
    function test_bishopcheck2()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'B', 'h7');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('h7', 'e4');
        $this->assertEquals(array('f5', 'g6', 'h7'), $err, 'wrong squares');
    }
    
    function test_bishopcheck3()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'B', 'b1');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('b1', 'e4');
        $this->assertEquals(array('d3', 'c2', 'b1'), $err, 'wrong squares');
    }
    
    function test_bishopcheck4()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'B', 'h1');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('h1', 'e4');
        $this->assertEquals(array('f3', 'g2', 'h1'), $err, 'wrong squares');
    }
    
    function test_rookcheck1()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'B', 'e1');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('e1', 'e4');
        $this->assertEquals(array('e3', 'e2', 'e1'), $err, 'wrong squares');
    }
    
    function test_rookcheck2()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'a4');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('a4', 'e4');
        $this->assertEquals(array('d4', 'c4', 'b4', 'a4'), $err, 'wrong squares');
    }
    
    function test_rookcheck3()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'e8');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('e8', 'e4');
        $this->assertEquals(array('e5', 'e6', 'e7', 'e8'), $err, 'wrong squares');
    }
    
    function test_rookcheck4()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'h4');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('h4', 'e4');
        $this->assertEquals(array('f4', 'g4', 'h4'), $err, 'wrong squares');
    }
    
    function test_queencheck1()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'a8');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('a8', 'e4');
        $this->assertEquals(array('d5', 'c6', 'b7', 'a8'), $err, 'wrong squares');
    }
    
    function test_queencheck2()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'h7');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('h7', 'e4');
        $this->assertEquals(array('f5', 'g6', 'h7'), $err, 'wrong squares');
    }
    
    function test_queencheck3()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'b1');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('b1', 'e4');
        $this->assertEquals(array('d3', 'c2', 'b1'), $err, 'wrong squares');
    }
    
    function test_queencheck4()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'h1');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('h1', 'e4');
        $this->assertEquals(array('f3', 'g2', 'h1'), $err, 'wrong squares');
    }
    
    function test_queencheck5()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'e1');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('e1', 'e4');
        $this->assertEquals(array('e3', 'e2', 'e1'), $err, 'wrong squares');
    }
    
    function test_queencheck6()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'a4');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('a4', 'e4');
        $this->assertEquals(array('d4', 'c4', 'b4', 'a4'), $err, 'wrong squares');
    }
    
    function test_queencheck7()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'e8');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('e8', 'e4');
        $this->assertEquals(array('e5', 'e6', 'e7', 'e8'), $err, 'wrong squares');
    }
    
    function test_queencheck8()
    {
        if (!$this->_methodExists('_getPathToKing')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'h4');
        $this->board->addPiece('W', 'K', 'e4');
        $err = $this->board->_getPathToKing('h4', 'e4');
        $this->assertEquals(array('f4', 'g4', 'h4'), $err, 'wrong squares');
    }
}

?>
