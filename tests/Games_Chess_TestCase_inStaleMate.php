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

class Games_Chess_TestCase_inStaleMate extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_inStaleMate($name)
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
    
    function test_valid_stalemate1()
    {
        // pieces would be able to move, but are pinned by check
        if (!$this->_methodExists('inStaleMate')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('W', 'K', 'e8');
        $this->board->addPiece('B', 'R', 'a8');
        $this->board->addPiece('W', 'N', 'd8');
        $this->board->addPiece('W', 'P', 'd7');
        $this->board->addPiece('W', 'P', 'e7');
        $this->board->addPiece('W', 'P', 'f7');
        $this->board->addPiece('W', 'B', 'f8');
        $this->board->addPiece('B', 'R', 'h8');
        $this->board->addPiece('B', 'K', 'e1');
        $this->assertTrue($err = $this->board->inStaleMate('W'));
        $this->assertTrue(!is_object($err), 'returned error');
        $this->assertFalse($this->board->inStaleMate('B'));
    }

    function test_valid_stalemate2()
    {
        // nothing can move at all
        if (!$this->_methodExists('inStaleMate')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'g4');
        $this->board->addPiece('B', 'P', 'g5');
        $this->board->addPiece('W', 'P', 'g3');
        $this->board->addPiece('W', 'K', 'h3');
        $this->board->addPiece('W', 'P', 'h2');
        $this->board->addPiece('W', 'P', 'g2');
        $this->board->addPiece('B', 'K', 'e8');
        $this->assertTrue($err = $this->board->inStaleMate('W'));
        $this->assertTrue(!is_object($err), 'returned error');
        $this->assertFalse($this->board->inStaleMate('B'));
    }

    function test_invalid_stalemate()
    {
        if (!$this->_methodExists('inStaleMate')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'g4');
        $this->board->addPiece('B', 'P', 'g5');
        $this->board->addPiece('W', 'P', 'g3');
        $this->board->addPiece('W', 'K', 'h3');
        // add a piece that can move
        $this->board->addPiece('W', 'P', 'h5');
        $this->board->addPiece('B', 'R', 'e2');
        $this->board->addPiece('B', 'K', 'e8');
        $this->assertFalse($err = $this->board->inStaleMate('W'));
        $this->assertFalse($this->board->inStaleMate('B'));
    }
}

?>
