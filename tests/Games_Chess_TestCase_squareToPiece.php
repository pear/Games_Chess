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

class Games_Chess_TestCase_squareToPiece extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_squareToPiece($name)
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
        if (!$this->_methodExists('_squareToPiece')) {
            return;
        }
        $this->assertFalse($this->board->_squareToPiece('a1'));
    }
    
    function test_valid_piece()
    {
        if (!$this->_methodExists('_squareToPiece')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->assertEquals(array('color' => 'W', 'piece' => 'R'),
            $this->board->_squareToPiece('a1'), 'wrong piece/color');
    }
    
    function test_valid_pawn()
    {
        if (!$this->_methodExists('_squareToPiece')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'a5');
        $this->board->addPiece('W', 'R', 'a6');
        $this->board->addPiece('W', 'R', 'a3');
        $this->assertEquals(array('color' => 'W', 'piece' => 'R'),
            $this->board->_squareToPiece('a3'), 'wrong piece/color');
    }
}

?>
