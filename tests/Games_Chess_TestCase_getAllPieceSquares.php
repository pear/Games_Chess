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

class Games_Chess_TestCase_getAllPieceSquares extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getAllPieceSquares($name)
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
    
    function test_valid_empty()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        $this->assertEquals(array(), $this->board->_getAllPieceSquares('N', 'W'));
        $this->assertEquals(array(), $this->board->_getAllPieceSquares('N', 'B'));
    }
    
    function test_valid_noneofcolorw()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'N', 'h5');
        $this->assertEquals(array(), $this->board->_getAllPieceSquares('N', 'W'));
    }
    
    function test_valid_piecew()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'h5');
        $this->assertEquals(array('h5'), $this->board->_getAllPieceSquares('N', 'W'));
    }
    
    function test_valid_piecesw()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'h5');
        $this->board->addPiece('W', 'N', 'a5');
        $this->assertEquals(array('h5', 'a5'), $this->board->_getAllPieceSquares('N', 'W'));
    }
    
    function test_valid_pieces_in_pawnw()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'h5');
        $this->board->addPiece('W', 'N', 'a5');
        $this->board->addPiece('W', 'N', 'g4');
        $this->assertEquals(array('h5', 'a5', 'g4'), $this->board->_getAllPieceSquares('N', 'W'));
    }
    
    function test_valid_excludew()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'h5');
        $this->board->addPiece('W', 'N', 'a5');
        $this->board->addPiece('W', 'N', 'g4');
        $this->assertEquals(array('h5', 'a5'), $this->board->_getAllPieceSquares('N', 'W', 'g4'));
        $this->assertEquals(array('h5', 'g4'), $this->board->_getAllPieceSquares('N', 'W', 'a5'));
    }
    
    function test_valid_noneofcolorb()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'h5');
        $this->assertEquals(array(), $this->board->_getAllPieceSquares('N', 'B'));
    }
    
    function test_valid_pieceb()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'N', 'h5');
        $this->assertEquals(array('h5'), $this->board->_getAllPieceSquares('N', 'B'));
    }
    
    function test_valid_piecesb()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'N', 'h5');
        $this->board->addPiece('B', 'N', 'a5');
        $this->assertEquals(array('h5', 'a5'), $this->board->_getAllPieceSquares('N', 'B'));
    }
    
    function test_valid_pieces_in_pawnb()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'N', 'h5');
        $this->board->addPiece('B', 'N', 'a5');
        $this->board->addPiece('B', 'N', 'g4');
        $this->assertEquals(array('g4', 'h5', 'a5'), $this->board->_getAllPieceSquares('N', 'B'));
    }
    
    function test_valid_excludeb()
    {
        if (!$this->_methodExists('_getAllPieceSquares')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'N', 'h5');
        $this->board->addPiece('B', 'N', 'a5');
        $this->board->addPiece('B', 'N', 'g4');
        $this->assertEquals(array('h5', 'a5'), $this->board->_getAllPieceSquares('N', 'B', 'g4'));
        $this->assertEquals(array('g4', 'h5'), $this->board->_getAllPieceSquares('N', 'B', 'a5'));
    }
}

?>
