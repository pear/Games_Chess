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

class Games_Chess_TestCase_inCheckMate extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_inCheckMate($name)
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
    
    function test_valid_checkmate1()
    {
        if (!$this->_methodExists('inCheckMate')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/1pp1p2p/2P5/p2P1ppQ/8/8/PP1P1PPP/RNB1KBNR b KQkq - 2 6');
        $this->assertSame(true, $this->board->inCheckmate('B'));
        $this->assertFalse($this->board->inCheckmate('W'));
    }
    /*
    function test_valid_checkmate2()
    {
        // smothered mate, my favorite :)
        if (!$this->_methodExists('inCheckMate')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'f7');
        $this->board->addPiece('B', 'K', 'h8');
        $this->board->addPiece('W', 'K', 'h2');
        $this->board->addPiece('B', 'P', 'h7');
        $this->board->addPiece('B', 'P', 'g7');
        $this->board->addPiece('B', 'R', 'g8');
        $this->assertSame(true, $this->board->inCheckmate('B'));
        $this->assertFalse($this->board->inCheckmate('W'));
    }
    
    function test_valid_checkmate3()
    {
        // double check = checkmate
        if (!$this->_methodExists('inCheckMate')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'f8');
        $this->board->addPiece('B', 'R', 'h8');
        $this->board->addPiece('B', 'K', 'g8');
        // add a piece that could interpose if it weren't double check
        $this->board->addPiece('B', 'B', 'e8');
        
        $this->board->addPiece('W', 'R', 'f1');
        $this->board->addPiece('W', 'N', 'e7');
        $this->board->addpiece('W', 'B', 'e4');
        $this->board->addPiece('W', 'R', 'g1');
        $this->board->addPiece('W', 'K', 'a1');
        $this->assertSame(true, $this->board->inCheckmate('B'));
        $this->assertFalse($this->board->inCheckmate('W'));
    }
    
    function test_invalid_checkmate1()
    {
        // interposition saves (temporarily in this case) the day
        if (!$this->_methodExists('inCheckMate')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'f8');
        $this->board->addPiece('B', 'R', 'h8');
        $this->board->addPiece('B', 'K', 'g8');
        // add a piece that can interpose
        $this->board->addPiece('B', 'B', 'e8');
        
        $this->board->addPiece('W', 'R', 'f1');
        $this->board->addpiece('W', 'B', 'e4');
        $this->board->addPiece('W', 'R', 'g1');
        $this->board->addPiece('W', 'K', 'a1');
        $this->assertFalse($this->board->inCheckmate('B'));
        $this->assertFalse($this->board->inCheckmate('W'));
    }
    
    function test_invalid_checkmate2()
    {
        // king can move to h7
        if (!$this->_methodExists('inCheckMate')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'f8');
        $this->board->addPiece('B', 'R', 'h8');
        $this->board->addPiece('B', 'K', 'g8');
        
        $this->board->addPiece('W', 'R', 'f1');
        $this->board->addPiece('W', 'R', 'g1');
        $this->board->addPiece('W', 'K', 'a1');
        $this->assertFalse($this->board->inCheckmate('B'));
        $this->assertFalse($this->board->inCheckmate('W'));
    }*/
}

?>
