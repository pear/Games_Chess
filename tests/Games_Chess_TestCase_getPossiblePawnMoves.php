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

class Games_Chess_TestCase_getPossiblePawnMoves extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getPossiblePawnMoves($name)
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
    
    function test_invalid1()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $err = $this->board->getPossiblePawnMoves('a1', 'Q');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'no error returned');
        $this->assertEquals('"Q" is not a valid piece color, try W or B',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid2()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $err = $this->board->getPossiblePawnMoves('a9', 'B');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'no error returned');
        $this->assertEquals('"a9" is not a valid square, must be between a1 and h8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_validw1()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossiblePawnMoves('b1', 'W');
        $this->assertEquals(array(), $err, 'wrong squares');
    }
    
    function test_validw2()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossiblePawnMoves('b2', 'W');
        $this->assertEquals(array('b3', 'b4'), $err, 'wrong squares');
    }
    
    function test_validw3()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'b4');
        $err = $this->board->getPossiblePawnMoves('b2', 'W');
        $this->assertEquals(array('b3'), $err, 'wrong squares');
    }
    
    function test_validw4()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('B', 'P', 'b4');
        $err = $this->board->getPossiblePawnMoves('b2', 'W');
        $this->assertEquals(array('b3'), $err, 'wrong squares');
    }
    
    function test_validw5()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('B', 'P', 'a3');
        $err = $this->board->getPossiblePawnMoves('b2', 'W');
        $this->assertEquals(array('b3', 'b4', 'a3'), $err, 'wrong squares');
    }
    
    function test_validw6()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('B', 'P', 'a3');
        $this->board->addPiece('B', 'P', 'c3');
        $err = $this->board->getPossiblePawnMoves('b2', 'W');
        $this->assertEquals(array('b3', 'b4', 'a3', 'c3'), $err, 'wrong squares');
    }
    
    function test_validw7()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a3');
        $this->board->addPiece('W', 'P', 'c3');
        $err = $this->board->getPossiblePawnMoves('b2', 'W');
        $this->assertEquals(array('b3', 'b4'), $err, 'wrong squares');
    }
    
    function test_validw8()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $err = $this->board->getPossiblePawnMoves('b3', 'W');
        $this->assertEquals(array('b4'), $err, 'wrong squares');
    }
    
    function test_validw9()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('B', 'P', 'a5');
        $this->board->_enPassantSquare = 'a6';
        $err = $this->board->getPossiblePawnMoves('b5', 'W');
        $this->assertEquals(array('a6', 'b6'), $err, 'wrong squares');
    }
    
    function test_validw10()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('B', 'P', 'a5');
        $err = $this->board->getPossiblePawnMoves('b5', 'W', 'a6');
        $this->assertEquals(array('a6', 'b6'), $err, 'wrong squares');
    }
    
    function test_validb1()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossiblePawnMoves('b8', 'B');
        $this->assertEquals(array(), $err, 'wrong squares');
    }
    
    function test_validb2()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->getPossiblePawnMoves('b7', 'B');
        $this->assertEquals(array('b6', 'b5'), $err, 'wrong squares');
    }
    
    function test_validb3()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('B', 'P', 'b5');
        $err = $this->board->getPossiblePawnMoves('b7', 'B');
        $this->assertEquals(array('b6'), $err, 'wrong squares');
    }
    
    function test_validb4()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('B', 'P', 'b5');
        $err = $this->board->getPossiblePawnMoves('b7', 'B');
        $this->assertEquals(array('b6'), $err, 'wrong squares');
    }
    
    function test_validb5()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a6');
        $err = $this->board->getPossiblePawnMoves('b7', 'B');
        $this->assertEquals(array('b6', 'b5', 'a6'), $err, 'wrong squares');
    }
    
    function test_validb6()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a6');
        $this->board->addPiece('W', 'P', 'c6');
        $err = $this->board->getPossiblePawnMoves('b7', 'B');
        $this->assertEquals(array('b6', 'b5', 'a6', 'c6'), $err, 'wrong squares');
    }
    
    function test_validb7()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('B', 'P', 'a6');
        $this->board->addPiece('B', 'P', 'c6');
        $err = $this->board->getPossiblePawnMoves('b7', 'B');
        $this->assertEquals(array('b6', 'b5'), $err, 'wrong squares');
    }
    
    function test_validb8()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $err = $this->board->getPossiblePawnMoves('b6', 'B');
        $this->assertEquals(array('b5'), $err, 'wrong squares');
    }
    
    function test_validb9()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a4');
        $this->board->_enPassantSquare = 'a3';
        $err = $this->board->getPossiblePawnMoves('b4', 'B');
        $this->assertEquals(array('a3', 'b3'), $err, 'wrong squares');
    }
    
    function test_validb10()
    {
        if (!$this->_methodExists('getPossiblePawnMoves')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a4');
        $err = $this->board->getPossiblePawnMoves('b4', 'B', 'a3');
        $this->assertEquals(array('a3', 'b3'), $err, 'wrong squares');
    }
}

?>
