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

class Games_Chess_TestCase_convertSquareToSAN extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_convertSquareToSAN($name)
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

    function PEARerrorHandler($error) {
        $this->assertEquals($this->_expectedCode, $error->getCode(),
            $this->_testMethod . ' ' . $this->errorCodeToString($this->_expectedCode)
            . ' actual: ' . $this->errorCodeToString($error->getCode()));
        $this->assertEquals($this->_expectedMessage, $error->getMessage(), $this->_testMethod);
        $this->errorThrown = 'true';
    }
    
    function expectPEARError($method, $msg, $code = null)
    {
        $this->_expectedMessage = $msg;
        $this->_expectedCode = $code;
        $this->_testMethod = $method;
    }
    
    function test_invalid_promote()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        $err = $this->board->_convertSquareToSAN('a1', 'a3', 'T');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('"T" is not a valid promotion piece, must be Q, R, N or B',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_from()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        $err = $this->board->_convertSquareToSAN('a9', 'a3', 'R');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('"a9" is not a valid square, must be between a1 and h8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_to()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        $err = $this->board->_convertSquareToSAN('a1', 'a9', 'R');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('"a9" is not a valid square, must be between a1 and h8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_nopiece()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        $err = $this->board->_convertSquareToSAN('a1', 'a3', 'R');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('There is no piece on square a1',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_wrongcolor()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'a1');
        $err = $this->board->_convertSquareToSAN('a1', 'a3', 'R');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on a1 is not your piece',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_invalid_move()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'a1');
        $err = $this->board->_convertSquareToSAN('a1', 'b3', 'R');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on a1 cannot move to b3',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_valid_pawnmove1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'a2');
        $err = $this->board->_convertSquareToSAN('a2', 'a3');
        $this->assertEquals('a3', $err, 'wrong SAN');
    }
    
    function test_valid_pawnmove2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'a2');
        $err = $this->board->_convertSquareToSAN('a2', 'a4');
        $this->assertEquals('a4', $err, 'wrong SAN');
    }
    
    function test_valid_pawnmove3()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'a2');
        $this->board->addPiece('B', 'P', 'b3');
        $err = $this->board->_convertSquareToSAN('a2', 'b3');
        $this->assertEquals('axb3', $err, 'wrong SAN');
    }
    
    function test_valid_pawnmove4()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'a5');
        $this->board->addPiece('B', 'P', 'b5');
        $this->board->_enPassantSquare = 'b6';
        $err = $this->board->_convertSquareToSAN('a5', 'b6');
        $this->assertEquals('axb6', $err, 'wrong SAN');
    }
    
    function test_valid_pawnpromote()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'a7');
        $err = $this->board->_convertSquareToSAN('a7', 'a8');
        $this->assertEquals('a8=Q', $err, 'wrong SAN');
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a7');
        $err = $this->board->_convertSquareToSAN('a7', 'a8', 'R');
        $this->assertEquals('a8=R', $err, 'wrong SAN');
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a7');
        $err = $this->board->_convertSquareToSAN('a7', 'a8', 'N');
        $this->assertEquals('a8=N', $err, 'wrong SAN');
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a7');
        $err = $this->board->_convertSquareToSAN('a7', 'a8', 'Q');
        $this->assertEquals('a8=Q', $err, 'wrong SAN');
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a7');
        $err = $this->board->_convertSquareToSAN('a7', 'a8', 'B');
        $this->assertEquals('a8=B', $err, 'wrong SAN');
        $this->board->blankBoard();
        $this->board->addPiece('W', 'P', 'a7');
        $this->board->addPiece('B', 'R', 'b8');
        $err = $this->board->_convertSquareToSAN('a7', 'b8');
        $this->assertEquals('axb8=Q', $err, 'wrong SAN');
    }
    
    function test_valid_knightmove1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'a5');
        $err = $this->board->_convertSquareToSAN('a5', 'b7');
        $this->assertEquals('Nb7', $err, 'wrong SAN');
    }
    
    function test_valid_knightmove2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'a5');
        $this->board->addPiece('B', 'N', 'b7');
        $err = $this->board->_convertSquareToSAN('a5', 'b7');
        $this->assertEquals('Nxb7', $err, 'wrong SAN');
    }
    
    function test_valid_knightmove_ambiguous1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'd5');
        $this->board->addPiece('W', 'N', 'h5');
        $err = $this->board->_convertSquareToSAN('d5', 'f6');
        $this->assertEquals('Ndf6', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'f6');
        $err = $this->board->_convertSquareToSAN('d5', 'f6');
        $this->assertEquals('Ndxf6', $err, 'wrong SAN');
    }
    
    function test_valid_knightmove_ambiguous2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'd5');
        $this->board->addPiece('W', 'N', 'd3');
        $err = $this->board->_convertSquareToSAN('d5', 'f4');
        $this->assertEquals('N5f4', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'f4');
        $err = $this->board->_convertSquareToSAN('d5', 'f4');
        $this->assertEquals('N5xf4', $err, 'wrong SAN');
    }
    
    function test_valid_knightmove_ambiguous3()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'd5');
        $this->board->addPiece('W', 'N', 'd3');
        $this->board->addPiece('W', 'N', 'h3');
        $err = $this->board->_convertSquareToSAN('d5', 'f4');
        $this->assertEquals('Nd5f4', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'f4');
        $err = $this->board->_convertSquareToSAN('d5', 'f4');
        $this->assertEquals('Nd5xf4', $err, 'wrong SAN');
    }
    
    function test_valid_bishopmove1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'a5');
        $err = $this->board->_convertSquareToSAN('a5', 'c7');
        $this->assertEquals('Bc7', $err, 'wrong SAN');
    }
    
    function test_valid_bishopmove2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'a5');
        $this->board->addPiece('B', 'B', 'c7');
        $err = $this->board->_convertSquareToSAN('a5', 'c7');
        $this->assertEquals('Bxc7', $err, 'wrong SAN');
    }
    
    function test_valid_bishopmove_ambiguous1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'd5');
        $this->board->addPiece('W', 'B', 'f5');
        $err = $this->board->_convertSquareToSAN('d5', 'e6');
        $this->assertEquals('Bde6', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'e6');
        $err = $this->board->_convertSquareToSAN('d5', 'e6');
        $this->assertEquals('Bdxe6', $err, 'wrong SAN');
    }
    
    function test_valid_bishopmove_ambiguous2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'd5');
        $this->board->addPiece('W', 'B', 'd3');
        $err = $this->board->_convertSquareToSAN('d5', 'e4');
        $this->assertEquals('B5e4', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'e4');
        $err = $this->board->_convertSquareToSAN('d5', 'e4');
        $this->assertEquals('B5xe4', $err, 'wrong SAN');
    }
    
    function test_valid_bishopmove_ambiguous3()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'd5');
        $this->board->addPiece('W', 'B', 'd3');
        $this->board->addPiece('W', 'B', 'f3');
        $err = $this->board->_convertSquareToSAN('d5', 'e4');
        $this->assertEquals('Bd5e4', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'e4');
        $err = $this->board->_convertSquareToSAN('d5', 'e4');
        $this->assertEquals('Bd5xe4', $err, 'wrong SAN');
    }
    
    function test_valid_queenmove1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'a5');
        $err = $this->board->_convertSquareToSAN('a5', 'c7');
        $this->assertEquals('Qc7', $err, 'wrong SAN');
    }
    
    function test_valid_queenmove2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'a5');
        $this->board->addPiece('B', 'Q', 'c7');
        $err = $this->board->_convertSquareToSAN('a5', 'c7');
        $this->assertEquals('Qxc7', $err, 'wrong SAN');
    }
    
    function test_valid_queenmove_ambiguous1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'd5');
        $this->board->addPiece('W', 'Q', 'f5');
        $err = $this->board->_convertSquareToSAN('d5', 'e6');
        $this->assertEquals('Qde6', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'e6');
        $err = $this->board->_convertSquareToSAN('d5', 'e6');
        $this->assertEquals('Qdxe6', $err, 'wrong SAN');
    }
    
    function test_valid_queenmove_ambiguous2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'd5');
        $this->board->addPiece('W', 'Q', 'd3');
        $err = $this->board->_convertSquareToSAN('d5', 'e4');
        $this->assertEquals('Q5e4', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'e4');
        $err = $this->board->_convertSquareToSAN('d5', 'e4');
        $this->assertEquals('Q5xe4', $err, 'wrong SAN');
    }
    
    function test_valid_queenmove_ambiguous3()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'd5');
        $this->board->addPiece('W', 'Q', 'd3');
        $this->board->addPiece('W', 'Q', 'f3');
        $err = $this->board->_convertSquareToSAN('d5', 'e4');
        $this->assertEquals('Qd5e4', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'e4');
        $err = $this->board->_convertSquareToSAN('d5', 'e4');
        $this->assertEquals('Qd5xe4', $err, 'wrong SAN');
    }
    
    function test_valid_rookmove1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'a5');
        $err = $this->board->_convertSquareToSAN('a5', 'a7');
        $this->assertEquals('Ra7', $err, 'wrong SAN');
    }
    
    function test_valid_rookmove2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'a5');
        $this->board->addPiece('B', 'R', 'a7');
        $err = $this->board->_convertSquareToSAN('a5', 'a7');
        $this->assertEquals('Rxa7', $err, 'wrong SAN');
    }
    
    function test_valid_rookmove_ambiguous1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'd5');
        $this->board->addPiece('W', 'R', 'f5');
        $err = $this->board->_convertSquareToSAN('d5', 'e5');
        $this->assertEquals('Rde5', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'e5');
        $err = $this->board->_convertSquareToSAN('d5', 'e5');
        $this->assertEquals('Rdxe5', $err, 'wrong SAN');
    }
    
    function test_valid_rookmove_ambiguous2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'd5');
        $this->board->addPiece('W', 'R', 'd3');
        $err = $this->board->_convertSquareToSAN('d5', 'd4');
        $this->assertEquals('R5d4', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'd4');
        $err = $this->board->_convertSquareToSAN('d5', 'd4');
        $this->assertEquals('R5xd4', $err, 'wrong SAN');
    }
    
    function test_valid_rookmove_ambiguous3()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'd5');
        $this->board->addPiece('W', 'R', 'd3');
        $this->board->addPiece('W', 'R', 'c4');
        $this->board->addPiece('W', 'R', 'f4');
        $err = $this->board->_convertSquareToSAN('d5', 'd4');
        $this->assertEquals('Rd5d4', $err, 'wrong SAN');
        $this->board->addPiece('B', 'Q', 'd4');
        $err = $this->board->_convertSquareToSAN('d5', 'd4');
        $this->assertEquals('Rd5xd4', $err, 'wrong SAN');
    }
    
    function test_valid_kingmove1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'a5');
        $err = $this->board->_convertSquareToSAN('a5', 'a6');
        $this->assertEquals('Ka6', $err, 'wrong SAN');
    }
    
    function test_valid_kingmove2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'K', 'a5');
        $this->board->addPiece('B', 'R', 'a6');
        $err = $this->board->_convertSquareToSAN('a5', 'a6');
        $this->assertEquals('Kxa6', $err, 'wrong SAN');
    }
    
    function test_valid_new_kingcastleW1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_WCastleK = true;
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('W', 'R', 'h1');
        $err = $this->board->_convertSquareToSAN('e1', 'g1');
        $this->assertEquals('O-O', $err, 'wrong SAN');
    }
    
    function test_valid_new_kingcastleW2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_WCastleQ = true;
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('W', 'R', 'a1');
        $err = $this->board->_convertSquareToSAN('e1', 'c1');
        $this->assertEquals('O-O-O', $err, 'wrong SAN');
    }
    
    function test_valid_new_kingcastleB1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_BCastleK = true;
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'K', 'e8');
        $this->board->addPiece('B', 'R', 'h8');
        $err = $this->board->_convertSquareToSAN('e8', 'g8');
        $this->assertEquals('O-O', $err, 'wrong SAN');
    }
    
    function test_valid_new_kingcastleB2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_BCastleQ = true;
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'K', 'e8');
        $this->board->addPiece('B', 'R', 'a8');
        $err = $this->board->_convertSquareToSAN('e8', 'c8');
        $this->assertEquals('O-O-O', $err, 'wrong SAN');
    }
    
    function test_invalid_new_kingcastleW1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_WCastleK = false;
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('W', 'R', 'h1');
        $err = $this->board->_convertSquareToSAN('e1', 'g1');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on e1 cannot move to g1',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_new_kingcastleW2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_WCastleQ = false;
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('W', 'R', 'a1');
        $err = $this->board->_convertSquareToSAN('e1', 'c1');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on e1 cannot move to c1',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_new_kingcastleW3()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_WCastleK = true;
        $this->board->addPiece('W', 'K', 'e2');
        $this->board->addPiece('W', 'R', 'h1');
        $err = $this->board->_convertSquareToSAN('e2', 'g1');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on e2 cannot move to g1',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_new_kingcastleW4()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_WCastleQ = true;
        $this->board->addPiece('W', 'K', 'e2');
        $this->board->addPiece('W', 'R', 'a1');
        $err = $this->board->_convertSquareToSAN('e2', 'c1');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on e2 cannot move to c1',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_new_kingcastleB1()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_BCastleK = false;
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'K', 'e8');
        $this->board->addPiece('B', 'R', 'h8');
        $err = $this->board->_convertSquareToSAN('e8', 'g8');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on e8 cannot move to g8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_new_kingcastleB2()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_BCastleQ = false;
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'K', 'e8');
        $this->board->addPiece('B', 'R', 'a8');
        $err = $this->board->_convertSquareToSAN('e8', 'c8');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on e8 cannot move to c8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_new_kingcastleB3()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_BCastleK = true;
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'K', 'e7');
        $this->board->addPiece('B', 'R', 'h8');
        $err = $this->board->_convertSquareToSAN('e7', 'g8');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on e7 cannot move to g8',
            $err->getMessage(), 'wrong error message');
    }
    
    function test_invalid_new_kingcastleB4()
    {
        if (!$this->_methodExists('_convertSquareToSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        $this->board->blankBoard();
        $this->board->_WCastleQ = true;
        $this->board->_move = 'B';
        $this->board->addPiece('B', 'K', 'e7');
        $this->board->addPiece('B', 'R', 'a8');
        $err = $this->board->_convertSquareToSAN('e7', 'c8');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error');
        $this->assertEquals('The piece on e7 cannot move to c8',
            $err->getMessage(), 'wrong error message');
    }
}

?>
