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

class Games_Chess_TestCase_getPossibleMoves extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getPossibleMoves($name)
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
    
    function test_invalid1()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        $err = $this->board->getPossibleMoves('P', 'a1', 'Q');
        $this->assertEquals('pear_error', get_class($err), 'no error returned');
        $this->assertEquals('"Q" is not a valid piece color, try W or B',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid2()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        $err = $this->board->getPossibleMoves('P', 'a9', 'B');
        $this->assertEquals('pear_error', get_class($err), 'no error returned');
        $this->assertEquals('"a9" is not a valid square, must be between a1 and h8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid3()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        $err = $this->board->getPossibleMoves('T', 'a8', 'B');
        $this->assertEquals('pear_error', get_class($err), 'no error returned');
        $this->assertEquals('"T" is not a valid piece, must be P, Q, R, N, K or B',
            $err->getMessage(), 'wrong error message');
    }

    function test_validP()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $res2 = $this->board->getPossibleMoves('P', 'e4', 'B');
        $res1 = $this->board->getPossiblePawnMoves('e4', 'B');
        $this->assertEquals($res1, $res2, 'incorrect squares black');
        $res2 = $this->board->getPossibleMoves('P', 'e4', 'W');
        $res1 = $this->board->getPossiblePawnMoves('e4', 'W');
        $this->assertEquals($res1, $res2, 'incorrect squares white');
    }

    function test_validR()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        if (!$this->_methodExists('getPossibleRookMoves')) {
            return;
        }
        $res2 = $this->board->getPossibleMoves('R', 'e4', 'B');
        $res1 = $this->board->getPossibleRookMoves('e4', 'B');
        $this->assertEquals($res1, $res2, 'incorrect squares black');
        $res2 = $this->board->getPossibleMoves('R', 'e4', 'W');
        $res1 = $this->board->getPossibleRookMoves('e4', 'W');
        $this->assertEquals($res1, $res2, 'incorrect squares white');
    }

    function test_validN()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        if (!$this->_methodExists('getPossibleKnightMoves')) {
            return;
        }
        $res2 = $this->board->getPossibleMoves('N', 'e4', 'B');
        $res1 = $this->board->getPossibleKnightMoves('e4', 'B');
        $this->assertEquals($res1, $res2, 'incorrect squares black');
        $res2 = $this->board->getPossibleMoves('N', 'e4', 'W');
        $res1 = $this->board->getPossibleKnightMoves('e4', 'W');
        $this->assertEquals($res1, $res2, 'incorrect squares white');
    }

    function test_validB()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        if (!$this->_methodExists('getPossibleBishopMoves')) {
            return;
        }
        $res2 = $this->board->getPossibleMoves('B', 'e4', 'B');
        $res1 = $this->board->getPossibleBishopMoves('e4', 'B');
        $this->assertEquals($res1, $res2, 'incorrect squares black');
        $res2 = $this->board->getPossibleMoves('B', 'e4', 'W');
        $res1 = $this->board->getPossibleBishopMoves('e4', 'W');
        $this->assertEquals($res1, $res2, 'incorrect squares white');
    }

    function test_validQ()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        if (!$this->_methodExists('getPossibleQueenMoves')) {
            return;
        }
        $res2 = $this->board->getPossibleMoves('Q', 'e4', 'B');
        $res1 = $this->board->getPossibleQueenMoves('e4', 'B');
        $this->assertEquals($res1, $res2, 'incorrect squares black');
        $res2 = $this->board->getPossibleMoves('Q', 'e4', 'W');
        $res1 = $this->board->getPossibleQueenMoves('e4', 'W');
        $this->assertEquals($res1, $res2, 'incorrect squares white');
    }

    function test_validK()
    {
        if (!$this->_methodExists('getPossibleMoves')) {
            return;
        }
        if (!$this->_methodExists('getPossibleKingMoves')) {
            return;
        }
        $res2 = $this->board->getPossibleMoves('K', 'e4', 'B');
        $res1 = $this->board->getPossibleKingMoves('e4', 'B');
        $this->assertEquals($res1, $res2, 'incorrect squares black');
        $res2 = $this->board->getPossibleMoves('K', 'e4', 'W');
        $res1 = $this->board->getPossibleKingMoves('e4', 'W');
        $this->assertEquals($res1, $res2, 'incorrect squares white');
    }
}

?>
