<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_bugEnPassant extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_bugEnPassant($name)
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
        $this->assertTrue(false, "$errstr at line $errline");
    }
    
    function test_enpassant()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'b5');
        $this->board->addPiece('B', 'P', 'a5');
        $this->board->_enPassantSquare = 'a6';
        $this->assertEquals(array('a5', 'P'), $this->board->_pieces['BP1']);
        $this->board->moveSAN('bxa6');
        $this->assertFalse($this->board->_pieces['BP1']);
        $this->assertEquals(array('a6', 'P'), $this->board->_pieces['WP1'], 'piece wrong');
        $this->assertEquals('a5', $this->board->_board['a5'], 'board square wrong');
    }
}

?>
