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

class Games_Chess_Losers_TestCase_gameOver extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_Losers_TestCase_gameOver($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->board = new Games_Chess_Losers();
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

    function test_valid_white_nopieces()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('B', 'K', 'e8');
        $this->board->addPiece('B', 'R', 'a8');
        $this->board->addPiece('W', 'K', 'f3');
        $this->board->_move = 'B';
        $this->assertEquals('W', $this->board->gameOver());
        $this->board->_move = 'W';
        $this->assertEquals('W', $this->board->gameOver());
    }

    function test_valid_black_nopieces()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('W', 'K', 'e8');
        $this->board->addPiece('W', 'R', 'a8');
        $this->board->addPiece('B', 'K', 'f3');
        $this->board->_move = 'B';
        $this->assertEquals('B', $this->board->gameOver());
        $this->board->_move = 'W';
        $this->assertEquals('B', $this->board->gameOver());
    }

    function test_invalid_piecesleft()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('W', 'K', 'e8');
        $this->board->addPiece('W', 'R', 'a8');
        $this->board->addPiece('B', 'K', 'f3');
        $this->board->addPiece('B', 'R', 'a3');
        $this->board->_move = 'B';
        $this->assertFalse($this->board->gameOver(), '1');
        $this->board->_move = 'W';
        $this->assertFalse($this->board->gameOver(), '1');
    }

    function test_valid_white_checkmated()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('W', 'K', 'h8');
        $this->board->addPiece('B', 'K', 'g7');
        $this->board->addPiece('B', 'R', 'h3');
        $this->assertEquals('W', $this->board->gameOver());
    }

    function test_valid_black_checkmated()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('B', 'K', 'h8');
        $this->board->addPiece('W', 'K', 'g7');
        $this->board->addPiece('W', 'R', 'h3');
        $this->board->_move = 'B';
        $this->assertEquals('B', $this->board->gameOver());
    }

    function test_valid_white_draw()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('W', 'K', 'h1');
        $this->board->addPiece('W', 'P', 'a3');
        $this->board->addPiece('B', 'P', 'a4');
        $this->board->addPiece('B', 'P', 'h2');
        $this->board->addPiece('B', 'K', 'h3');
        $this->assertEquals('D', $this->board->gameOver());
    }

    function test_valid_black_draw()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->addPiece('B', 'K', 'h8');
        $this->board->addPiece('W', 'P', 'a3');
        $this->board->addPiece('B', 'P', 'a4');
        $this->board->addPiece('W', 'P', 'h7');
        $this->board->addPiece('W', 'K', 'h6');
        $this->board->_move = 'B';
        $this->assertEquals('D', $this->board->gameOver());
    }
}

?>
