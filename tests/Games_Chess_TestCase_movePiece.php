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

class Games_Chess_TestCase_movePiece extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_movePiece($name)
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
    
    function test_piece()
    {
        if (!$this->_methodExists('_movePiece')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'e4');
        $this->assertEquals('e4', $this->board->_pieces['WB1'], 'setup test');
        $this->board->_movePiece('e4', 'h7');
        $this->assertEquals('h7', $this->board->_pieces['WB1'], 'move test');
    }
    
    function test_pawn()
    {
        if (!$this->_methodExists('_movePiece')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'e4');
        $this->assertEquals(array('e4', 'P'), $this->board->_pieces['WP1'], 'setup test');
        $this->board->_movePiece('e4', 'e5');
        $this->assertEquals(array('e5', 'P'), $this->board->_pieces['WP1'], 'move test');
    }
    
    function test_promotedpiece()
    {
        if (!$this->_methodExists('_movePiece')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'e4');
        $this->board->addPiece('W', 'B', 'e5');
        $this->board->addPiece('W', 'B', 'e6');
        $this->assertEquals(array('e6', 'B'), $this->board->_pieces['WP1'], 'setup test');
        $this->board->_movePiece('e6', 'd5');
        $this->assertEquals(array('d5', 'B'), $this->board->_pieces['WP1'], 'move test');
    }
}

?>
