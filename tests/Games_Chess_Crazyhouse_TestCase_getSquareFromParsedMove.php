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

class Games_Chess_Crazyhouse_TestCase_getSquareFromParsedMove extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_Crazyhouse_TestCase_getSquareFromParsedMove($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->board = new Games_Chess_Crazyhouse();
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
    
    function test_getKing()
    {
        if (!$this->_methodExists('_getSquareFromParsedMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/1pp1p2p/2P5/p2P1ppQ/8/8/PP1P1PPP/RNB1KBNR w KQkq - 2 6');
        $a = $this->board->_parseMove('Kd1');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('e1', $err, 'wrong king square');
        $err = $this->board->resetGame('rnbqkbnr/1pp1p2p/2P5/p2P1ppQ/8/8/PP1P1PPP/RNB1KBNR b KQkq - 2 6');
        $a = $this->board->_parseMove('Kf7');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('e8', $err, 'wrong king square');
    }
    
    function test_getsimple()
    {
        if (!$this->_methodExists('_getSquareFromParsedMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/1pp1p2p/2P5/p2P1ppQ/8/8/PP1P1PP1/RNB1KBNR w KQkq - 2 6');
        $a = $this->board->_parseMove('Qh4');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('h5', $err, 'wrong queen square');
        $a = $this->board->_parseMove('Nf3');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('g1', $err, 'wrong knight square');
        $a = $this->board->_parseMove('Be2');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('f1', $err, 'wrong bishop square');
        $this->board->_pieces['WP8'] = false;
        $a = $this->board->_parseMove('Rh2');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('h1', $err, 'wrong rook square');
        $a = $this->board->_parseMove('Ke2');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('e1', $err, 'wrong king square');
        $a = $this->board->_parseMove('g4');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('g2', $err, 'wrong pawn square');
    }
    
    function test_getambiguous1()
    {
        if (!$this->_methodExists('_getSquareFromParsedMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'h2');
        $this->board->addPiece('W', 'Q', 'h6');
        $a = $this->board->_parseMove('Q6h4');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('h6', $err, 'wrong queen square');
    }
    
    function test_getambiguous2()
    {
        if (!$this->_methodExists('_getSquareFromParsedMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'h2');
        $this->board->addPiece('W', 'Q', 'e4');
        $a = $this->board->_parseMove('Qhh4');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('h2', $err, 'wrong queen square');
    }
    
    function test_getambiguous3()
    {
        if (!$this->_methodExists('_getSquareFromParsedMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'h2');
        $this->board->addPiece('W', 'Q', 'e4');
        $a = $this->board->_parseMove('Qhh4');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('h2', $err, 'wrong queen square');
    }
    
    function test_getambiguous4()
    {
        if (!$this->_methodExists('_getSquareFromParsedMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'h2');
        $this->board->addPiece('W', 'Q', 'e4');
        $this->board->addPiece('W', 'Q', 'a1');
        $a = $this->board->_parseMove('Qaa2');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('a1', $err, 'wrong queen square');
    }
    
    function test_invalid_getambiguous1()
    {
        if (!$this->_methodExists('_getSquareFromParsedMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'h2');
        $this->board->addPiece('W', 'Q', 'e4');
        $a = $this->board->_parseMove('Qh4');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('"Qh4" does not resolve ambiguity between Queens on h2 e4',
            $err->getMessage(),
            'wrong error message');
        }
    }
    
    function test_invalid_king()
    {
        if (!$this->_methodExists('_getSquareFromParsedMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'h2');
        $a = $this->board->_parseMove('Ka1');
        $err = $this->board->_getSquareFromParsedMove(current($a));
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There are no White pieces on the board that can do "Ka1"',
            $err->getMessage(),
            'wrong error message');
        }
    }
}

?>
