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

class Games_Chess_TestCase_moveAlgebraic extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_moveAlgebraic($name)
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
        if (in_array(strtolower($name), get_class_methods($this->board))) {
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
    
    function test_simple()
    {
        if (!$this->_methodExists('_moveAlgebraic')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'e4');
        $this->assertEquals('e4', $this->board->_pieces['WB1'], 'setup test 1');
        $this->assertEquals('WB1', $this->board->_board['e4'], 'setup test 2');
        $this->assertEquals('h7', $this->board->_board['h7'], 'setup test 3');
        $this->board->_moveAlgebraic('e4', 'h7');
        $this->assertEquals('h7', $this->board->_pieces['WB1'], 'move test 1');
        $this->assertEquals('e4', $this->board->_board['e4'], 'move test 2');
        $this->assertEquals('WB1', $this->board->_board['h7'], 'move test 3');
    }
    
    function test_capture()
    {
        if (!$this->_methodExists('_moveAlgebraic')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'e4');
        $this->board->addPiece('B', 'B', 'h7');
        $this->assertEquals('e4', $this->board->_pieces['WB1'], 'setup test 1');
        $this->assertEquals('WB1', $this->board->_board['e4'], 'setup test 2');
        $this->assertEquals('BB1', $this->board->_board['h7'], 'setup test 3');
        $this->assertEquals('h7', $this->board->_pieces['BB1'], 'setup test 4');
        $this->board->_moveAlgebraic('e4', 'h7');
        $this->assertEquals('h7', $this->board->_pieces['WB1'], 'move test 1');
        $this->assertEquals('e4', $this->board->_board['e4'], 'move test 2');
        $this->assertEquals('WB1', $this->board->_board['h7'], 'move test 3');
        $this->assertFalse($this->board->_pieces['BB1'], 'move test 4');
    }
}

?>
