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

class Games_Chess_Losers_TestCase_validMove extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_Losers_TestCase_validMove($name)
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
    
    function test_invalid_pawnmove1()
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
        $this->board->addPiece('W', 'P', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('exf3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There are no White pieces on the board that can do "exf3"',
                $err->getMessage(), 'wrong error message');
        }
    }
    
    function test_invalid_pawnmove2()
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
        $this->board->addPiece('W', 'P', 'e2');
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('B', 'Q', 'a5');
        $err = $this->board->_validMove($this->board->_parseMove('e3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('The move does not remove the check on the king',
                $err->getMessage(), 'wrong error message');
        }
    }
    
    function test_valid_pawnmove1()
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
        $this->board->addPiece('W', 'P', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('e3'));
        $this->assertSame(true, $err, 'valid pawn move');
    }
    
    function test_valid_pawnmove2()
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
        $this->board->addPiece('W', 'R', 'e2');
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('B', 'Q', 'a5');
        $err = $this->board->_validMove($this->board->_parseMove('Rd2'));
        $this->assertSame(true, $err, 'should work');
    }
    
    function test_valid_pawnmove_ep2()
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
        $this->board->addPiece('W', 'P', 'e5');
        $this->board->addPiece('B', 'P', 'd5');
        $this->board->_enPassantSquare = 'd6';
        $err = $this->board->_validMove($this->board->_parseMove('exd6'));
        $this->assertFalse(is_object($err), 'should work');
        if (is_object($err)) {
            $this->assertEquals($err->getMessage(), false);
        }
    }
    
    function test_invalid_piecemove1()
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
        $this->board->addPiece('W', 'B', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Bxf3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There is no piece on square f3',
                $err->getMessage(), 'wrong error message');
        }
        $err = $this->board->_validMove($this->board->_parseMove('Bxg3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There are no White pieces on the board that can do "Bxg3"',
                $err->getMessage(), 'wrong error message');
        }

        $this->board->blankBoard();
        $this->board->addPiece('W', 'Q', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Qxf3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There is no piece on square f3',
                $err->getMessage(), 'wrong error message');
        }
        $err = $this->board->_validMove($this->board->_parseMove('Qxg3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There are no White pieces on the board that can do "Qxg3"',
                $err->getMessage(), 'wrong error message');
        }

        $this->board->blankBoard();
        $this->board->addPiece('W', 'N', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Nxf4'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There is no piece on square f4',
                $err->getMessage(), 'wrong error message');
        }
        $err = $this->board->_validMove($this->board->_parseMove('Nxf3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There are no White pieces on the board that can do "Nxf3"',
                $err->getMessage(), 'wrong error message');
        }

        $this->board->blankBoard();
        $this->board->addPiece('W', 'R', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Rxe4'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There is no piece on square e4',
                $err->getMessage(), 'wrong error message');
        }
        $err = $this->board->_validMove($this->board->_parseMove('Rxf3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There are no White pieces on the board that can do "Rxf3"',
                $err->getMessage(), 'wrong error message');
        }

        $this->board->blankBoard();
        $this->board->addPiece('W', 'K', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Kxe3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There is no piece on square e3',
                $err->getMessage(), 'wrong error message');
        }
        $err = $this->board->_validMove($this->board->_parseMove('Kxg3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('There are no White pieces on the board that can do "Kxg3"',
                $err->getMessage(), 'wrong error message');
        }
    }
    
    function test_invalid_piecemove2()
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
        $this->board->addPiece('W', 'P', 'e2');
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('B', 'Q', 'a5');
        $err = $this->board->_validMove($this->board->_parseMove('e3'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('The move does not remove the check on the king',
                $err->getMessage(), 'wrong error message');
        }
    }
    
    function test_invalid_piecemove3()
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
        $this->board->addPiece('W', 'P', 'd2');
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('B', 'Q', 'a5');
        $err = $this->board->_validMove($this->board->_parseMove('d4'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('That move would put the king in check',
                $err->getMessage(), 'wrong error message');
        }
    }
    
    function test_valid_piecemove1()
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
        $this->board->addPiece('W', 'B', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Bf3'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'B', 'f3');
        $err = $this->board->_validMove($this->board->_parseMove('Bxf3'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');

        $this->board->blankBoard();
        $this->board->addPiece('W', 'Q', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Qf3'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'Q', 'f3');
        $err = $this->board->_validMove($this->board->_parseMove('Qxf3'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');

        $this->board->blankBoard();
        $this->board->addPiece('W', 'N', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Nf4'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'B', 'f4');
        $err = $this->board->_validMove($this->board->_parseMove('Nxf4'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');

        $this->board->blankBoard();
        $this->board->addPiece('W', 'R', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Re3'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'B', 'e3');
        $err = $this->board->_validMove($this->board->_parseMove('Rxe3'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');

        $this->board->blankBoard();
        $this->board->addPiece('W', 'K', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Kf3'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'B', 'f3');
        $err = $this->board->_validMove($this->board->_parseMove('Kxf3'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');
    }
    
    function test_valid_piecemove2()
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
        $this->board->addPiece('W', 'B', 'a1');
        $this->board->addPiece('W', 'B', 'a2');
        $this->board->addPiece('W', 'B', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Bf3'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'B', 'f3');
        $err = $this->board->_validMove($this->board->_parseMove('Bxf3'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');

        $this->board->blankBoard();
        $this->board->addPiece('W', 'Q', 'a1');
        $this->board->addPiece('W', 'Q', 'a2');
        $this->board->addPiece('W', 'Q', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Qf3'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'Q', 'f3');
        $err = $this->board->_validMove($this->board->_parseMove('Qxf3'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');

        $this->board->blankBoard();
        $this->board->addPiece('W', 'N', 'a1');
        $this->board->addPiece('W', 'N', 'a2');
        $this->board->addPiece('W', 'N', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Nf4'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'B', 'f4');
        $err = $this->board->_validMove($this->board->_parseMove('Nxf4'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');

        $this->board->blankBoard();
        $this->board->addPiece('W', 'R', 'a1');
        $this->board->addPiece('W', 'R', 'a2');
        $this->board->addPiece('W', 'R', 'e2');
        $err = $this->board->_validMove($this->board->_parseMove('Re3'));
        $this->assertFalse(is_object($err), 'bishop move did not work');
        $this->board->addPiece('B', 'B', 'e3');
        $err = $this->board->_validMove($this->board->_parseMove('Rxe3'));
        $this->assertFalse(is_object($err), 'bishop capture did not work');
    }

    function test_invalid_castleb1()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle kingside, pieces are in the way',
                $err->getMessage(), 'wrong error message 1');
        }
        $this->board->resetGame('rnbqk1nr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle kingside, pieces are in the way',
                $err->getMessage(), 'wrong error message 2');
        }
        $this->board->resetGame('rnbqkb1r/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle kingside, pieces are in the way',
                $err->getMessage(), 'wrong error message 3');
        }

        $this->board->resetGame();
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, pieces are in the way',
                $err->getMessage(), 'wrong error message 4');
        }
        $this->board->resetGame('r1bqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, pieces are in the way',
                $err->getMessage(), 'wrong error message 5');
        }
        $this->board->resetGame('r2qkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, pieces are in the way',
                $err->getMessage(), 'wrong error message');
        }
        $this->board->resetGame('rnb1kbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, pieces are in the way',
                $err->getMessage(), 'wrong error message 6');
        }
    }

    function test_invalid_castleb2()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('_moveAlgebraic')) {
            return;
        }
        $this->board->resetGame('rbnqk2r/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertFalse(is_object($err), 'O-O should work');
        $this->board->resetGame('rbnqk2r/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error 1');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle kingside, either the king or rook has moved',
                $err->getMessage(), 'wrong error message');
        }
        $this->board->resetGame('r3kbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertFalse(is_object($err), 'O-O-O should work');
        $this->board->resetGame('r3kbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQk - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error 2');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, either the king or rook has moved',
                $err->getMessage(), 'wrong error message');
        }
    }

    function test_invalid_castlew1()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle kingside, pieces are in the way',
                $err->getMessage(), 'wrong error message');
        }
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQK1NR w KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle kingside, pieces are in the way',
                $err->getMessage(), 'wrong error message');
        }
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKB1R w KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle kingside, pieces are in the way',
                $err->getMessage(), 'wrong error message');
        }

        $this->board->resetGame();
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, pieces are in the way',
                $err->getMessage(), 'wrong error message');
        }
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNB1KBNR w KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, pieces are in the way',
                $err->getMessage(), 'wrong error message');
        }
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/R1B1KBNR w KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, pieces are in the way',
                $err->getMessage(), 'wrong error message');
        }
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RN2KBNR w KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, pieces are in the way',
                $err->getMessage(), 'wrong error message');
        }
    }

    function test_invalid_castlew2()
    {
        if (!$this->_methodExists('_validMove')) {
            return;
        }
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('_moveAlgebraic')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQK2R w KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertFalse(is_object($err), 'O-O should work');
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQK2R w Qkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle kingside, either the king or rook has moved',
                $err->getMessage(), 'wrong error message');
        }
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/R3KBNR w KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertFalse(is_object($err), 'O-O-O should work');
        $this->board->resetGame('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/R3KBNR w Kkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        if (is_object($err)) {
            $this->assertEquals('Can\'t castle queenside, either the king or rook has moved',
                $err->getMessage(), 'wrong error message');
        }
    }
    
    function test_valid_castlew_k()
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
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('W', 'R', 'h1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertFalse(is_object($err), 'error returned');
    }
    
    function test_valid_castleb_k()
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
        $this->board->addPiece('B', 'R', 'h8');
        $this->board->_move = 'B';
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertFalse(is_object($err), 'error returned');
    }
    
    function test_valid_castlew_q()
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
        $this->board->addPiece('W', 'K', 'e1');
        $this->board->addPiece('W', 'R', 'a1');
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertFalse(is_object($err), 'error returned');
    }
    
    function test_valid_castleb_q()
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
        $this->board->_move = 'B';
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertFalse(is_object($err), 'error returned');
    }
    
    function test_invalid_must_capture_w()
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
        $this->board->resetGame('rnbqkbnr/pppppppp/B7/8/8/8/PPPPPPPP/RN1QKBNR w KQkq - 0 1');
        $err = $this->board->_validMove($this->board->_parseMove('Bxb7'));
        $this->assertFalse(is_object($err), 'error returned');
        $err = $this->board->_validMove($this->board->_parseMove('Nf3'));
        $this->assertTrue(is_object($err), 'no error returned');
        if (is_object($err)) {
            $this->assertEquals('Capture is possible, "Nf3" does not capture',
                $err->getMessage(), 'wrong error message');
        }
        $err = $this->board->_validMove($this->board->_parseMove('O-O'));
        $this->assertTrue(is_object($err), 'no error returned');
        if (is_object($err)) {
            $this->assertEquals('Capture is possible, "O-O" does not capture',
                $err->getMessage(), 'wrong error message');
        }
        $err = $this->board->_validMove($this->board->_parseMove('O-O-O'));
        $this->assertTrue(is_object($err), 'no error returned');
        if (is_object($err)) {
            $this->assertEquals('Capture is possible, "O-O-O" does not capture',
                $err->getMessage(), 'wrong error message');
        }
    }
}

?>
