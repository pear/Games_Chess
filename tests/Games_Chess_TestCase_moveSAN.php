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

class Games_Chess_TestCase_moveSAN extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_moveSAN($name)
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
    
    function test_pawnmove1()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'W';
        $this->board->_enPassantSquare = 'e6';
        $err = $this->board->addPiece('W', 'P', 'e4');
        $this->assertFalse(is_object($err), 'adding pawn failed');
        $err = $this->board->moveSAN('e5');
        $this->assertFalse(is_object($err), 'moving pawn failed');
        $this->assertEquals(1, $this->board->_halfMoves, 'half moves did not reset');
        $this->assertEquals('B', $this->board->_move, 'move color did not increment');
        $this->assertEquals(1, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not reset');
    }
    
    function test_pawnmove2()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'W';
        $this->board->_enPassantSquare = 'e6';
        $err = $this->board->addPiece('W', 'P', 'e2');
        $this->assertFalse(is_object($err), 'adding pawn failed');
        $err = $this->board->moveSAN('e4');
        $this->assertFalse(is_object($err), 'moving pawn failed');
        $this->assertEquals(1, $this->board->_halfMoves, 'half moves did not reset');
        $this->assertEquals('B', $this->board->_move, 'move color did not increment');
        $this->assertEquals(1, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('e3', $this->board->_enPassantSquare, 'en passant not set');
    }
    
    function test_pawnmove3()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'W';
        $this->board->_enPassantSquare = 'd6';
        $err = $this->board->addPiece('W', 'P', 'e5');
        $this->assertFalse(is_object($err), 'adding W pawn failed');
        $err = $this->board->addPiece('B', 'P', 'd5');
        $this->assertFalse(is_object($err), 'adding B pawn failed');
        $err = $this->board->moveSAN('exd6');
        $this->assertFalse(is_object($err), 'capturing pawn failed');
        $this->assertEquals(1, $this->board->_halfMoves, 'half moves did not reset');
        $this->assertEquals('B', $this->board->_move, 'move color did not increment');
        $this->assertEquals(1, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not set');
    }
    
    function test_pawnmove4()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'B';
        $this->board->_enPassantSquare = 'e3';
        $err = $this->board->addPiece('W', 'P', 'e4');
        $this->assertFalse(is_object($err), 'adding W pawn failed');
        $err = $this->board->addPiece('B', 'P', 'd4');
        $this->assertFalse(is_object($err), 'adding B pawn failed');
        $err = $this->board->moveSAN('dxe3');
        $this->assertFalse(is_object($err), 'capturing pawn failed');
        $this->assertEquals(1, $this->board->_halfMoves, 'half moves did not reset');
        $this->assertEquals('W', $this->board->_move, 'move color did not increment');
        $this->assertEquals(2, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not set');
    }
    
    function test_invalidpawnmove1()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'W';
        $err = $this->board->addPiece('W', 'P', 'e4');
        $this->assertFalse(is_object($err), 'adding W pawn failed');
        $err = $this->board->moveSAN('exd5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'capturing worked?');
        if (is_object($err)) {
            $this->assertEquals('There are no White pieces on the board that can do "exd5"',
                $err->message, 'wrong message');
        }
        $this->assertEquals(6, $this->board->_halfMoves, 'half moves did not reset');
        $this->assertEquals('W', $this->board->_move, 'move color did not increment');
        $this->assertEquals(1, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not set');
    }
    
    function test_piecemove1()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'W';
        $this->board->_enPassantSquare = 'e3';
        $err = $this->board->addPiece('W', 'N', 'e4');
        $this->assertFalse(is_object($err), 'adding W knight failed');
        $err = $this->board->moveSAN('Nf6');
        $this->assertFalse(is_object($err), 'moving knight failed');
        $this->assertEquals(7, $this->board->_halfMoves, 'half moves did not increment');
        $this->assertEquals('B', $this->board->_move, 'move color did not increment');
        $this->assertEquals(1, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not reset');
    }
    
    function test_piecemove2()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'B';
        $this->board->_enPassantSquare = 'e3';
        $err = $this->board->addPiece('B', 'N', 'e4');
        $this->assertFalse(is_object($err), 'adding W knight failed');
        $err = $this->board->moveSAN('Nf6');
        $this->assertFalse(is_object($err), 'moving knight failed');
        $this->assertEquals(7, $this->board->_halfMoves, 'half moves did not increment');
        $this->assertEquals('W', $this->board->_move, 'move color did not increment');
        $this->assertEquals(2, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not reset');
    }
    
    function test_piecemove3()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'B';
        $this->board->_enPassantSquare = 'e3';
        $err = $this->board->addPiece('B', 'N', 'e4');
        $this->assertFalse(is_object($err), 'adding B knight failed');
        $err = $this->board->addPiece('W', 'N', 'f6');
        $this->assertFalse(is_object($err), 'adding w knight failed');
        $err = $this->board->moveSAN('Nxf6');
        $this->assertFalse(is_object($err), 'capturing knight failed');
        $this->assertEquals(1, $this->board->_halfMoves, 'half moves did not reset');
        $this->assertEquals('W', $this->board->_move, 'move color did not increment');
        $this->assertEquals(2, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not reset');
    }
    
    function test_invalid_piecemove1()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_move = 'B';
        $this->board->_enPassantSquare = 'e3';
        $err = $this->board->addPiece('B', 'N', 'e4');
        $this->assertFalse(is_object($err), 'adding W knight failed');
        $err = $this->board->moveSAN('Nxf6');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'capturing worked?');
        if (is_object($err)) {
            $this->assertEquals('There is no piece on square f6',
                $err->message, 'wrong message');
        }
        $this->assertEquals(6, $this->board->_halfMoves, 'half moves did not increment');
        $this->assertEquals('B', $this->board->_move, 'move color did not increment');
        $this->assertEquals(1, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('e3', $this->board->_enPassantSquare, 'en passant not reset');
    }
    
    function test_moveking()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $this->board->_BCastleQ = $this->board->_BCastleK = true;
        $err = $this->board->addPiece('W', 'K', 'e1');
        $this->assertFalse(is_object($err), 'adding W king failed');
        $err = $this->board->addPiece('B', 'K', 'e8');
        $this->assertFalse(is_object($err), 'adding B king failed');
        $err = $this->board->moveSAN('Ke2');
        $this->assertFalse(is_object($err), 'moving W king failed');
        $this->assertTrue($this->board->_BCastleQ, 'BQ cleared');
        $this->assertTrue($this->board->_BCastleK, 'BK cleared');
        $this->assertFalse($this->board->_WCastleQ, 'WQ not cleared');
        $this->assertFalse($this->board->_WCastleK, 'WK not cleared');
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $err = $this->board->moveSAN('Ke7');
        $this->assertFalse(is_object($err), 'moving B king failed');
        $this->assertFalse($this->board->_BCastleQ, 'BQ not cleared');
        $this->assertFalse($this->board->_BCastleK, 'BK not cleared');
        $this->assertTrue($this->board->_WCastleQ, 'WQ cleared');
        $this->assertTrue($this->board->_WCastleK, 'WK cleared');
    }
    
    function test_moverook()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $this->board->_BCastleQ = $this->board->_BCastleK = true;
        $err = $this->board->addPiece('W', 'R', 'a1');
        $this->assertFalse(is_object($err), 'adding W rook 1 failed');
        $err = $this->board->moveSAN('Ra3');
        $this->assertFalse(is_object($err), 'moving W rook 1 failed');
        $this->assertTrue($this->board->_BCastleQ, 'BQ cleared 1');
        $this->assertTrue($this->board->_BCastleK, 'BK cleared 1');
        $this->assertFalse($this->board->_WCastleQ, 'WQ not cleared 1');
        $this->assertTrue($this->board->_WCastleK, 'WK cleared 1');
        $this->board->_QCastleW = $this->board->_QCastleB = true;
        $this->board->_KCastleW = $this->board->_KCastleB = true;
        $this->board->resetGame();
        $this->board->blankBoard();
        $err = $this->board->addPiece('W', 'R', 'h1');
        $this->assertFalse(is_object($err), 'adding W rook 2 failed');
        $err = $this->board->moveSAN('Rh8');
        $this->assertFalse(is_object($err), 'moving W rook 2 failed');
        $this->assertTrue($this->board->_BCastleQ, 'BQ cleared 2');
        $this->assertTrue($this->board->_BCastleK, 'BK cleared 2');
        $this->assertTrue($this->board->_WCastleQ, 'WQ cleared 2');
        $this->assertFalse($this->board->_WCastleK, 'WK not cleared 2');

        $this->board->resetGame();
        $this->board->blankBoard();
        $this->board->_move = 'B';
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $this->board->_BCastleQ = $this->board->_BCastleK = true;
        $err = $this->board->addPiece('B', 'R', 'a8');
        $this->assertFalse(is_object($err), 'adding B rook 1 failed');
        $err = $this->board->addPiece('B', 'R', 'h8');
        $this->assertFalse(is_object($err), 'adding B rook 2 failed');
        $err = $this->board->moveSAN('Ra6');
        $this->assertFalse(is_object($err), 'moving B rook 1 failed');
        $this->assertFalse($this->board->_BCastleQ, 'BQ not cleared 3');
        $this->assertTrue($this->board->_BCastleK, 'BK cleared 3');
        $this->assertTrue($this->board->_WCastleQ, 'WQ cleared 3');
        $this->assertTrue($this->board->_WCastleK, 'WK cleared 3');
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $this->board->_BCastleQ = $this->board->_BCastleK = true;
        $this->board->_move = 'B';
        $err = $this->board->moveSAN('Rh7');
        $this->assertFalse(is_object($err), 'moving B rook 2 failed');
        $this->assertTrue($this->board->_BCastleQ, 'BQ cleared 4');
        $this->assertFalse($this->board->_BCastleK, 'BK not cleared 4');
        $this->assertTrue($this->board->_WCastleQ, 'WQ cleared 4');
        $this->assertTrue($this->board->_WCastleK, 'WK cleared 4');
    }
    
    function test_castlekw()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $this->board->_BCastleQ = $this->board->_BCastleK = true;
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_enPassantSquare = 'e3';
        $err = $this->board->addPiece('W', 'R', 'h1');
        $this->assertFalse(is_object($err), 'adding W rook failed');
        $err = $this->board->addPiece('W', 'K', 'e1');
        $this->assertFalse(is_object($err), 'adding W king failed');
        $err = $this->board->moveSAN('O-O');
        $this->assertFalse(is_object($err), 'castling kingside failed');
        if (is_object($err)) {
            $this->assertEquals($err->message,'');
        }
        $this->assertTrue($this->board->_BCastleQ, 'BQ cleared');
        $this->assertTrue($this->board->_BCastleK, 'BK cleared');
        $this->assertFalse($this->board->_WCastleQ, 'WQ not cleared');
        $this->assertFalse($this->board->_WCastleK, 'WK not cleared');
        $this->assertEquals(7, $this->board->_halfMoves, 'half moves did not increment');
        $this->assertEquals('B', $this->board->_move, 'move color did not increment');
        $this->assertEquals(1, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not reset');
    }
    
    function test_castlekb()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $this->board->_BCastleQ = $this->board->_BCastleK = true;
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_enPassantSquare = 'e3';
        $this->board->_move = 'B';
        $err = $this->board->addPiece('B', 'R', 'h8');
        $this->assertFalse(is_object($err), 'adding B rook failed');
        $err = $this->board->addPiece('B', 'K', 'e8');
        $this->assertFalse(is_object($err), 'adding B king failed');
        $err = $this->board->moveSAN('O-O');
        $this->assertFalse(is_object($err), 'castling kingside failed');
        if (is_object($err)) {
            $this->assertEquals($err->message,'');
        }
        $this->assertTrue($this->board->_WCastleQ, 'WQ cleared');
        $this->assertTrue($this->board->_WCastleK, 'WK cleared');
        $this->assertFalse($this->board->_BCastleQ, 'BQ not cleared');
        $this->assertFalse($this->board->_BCastleK, 'BK not cleared');
        $this->assertEquals(7, $this->board->_halfMoves, 'half moves did not increment');
        $this->assertEquals('W', $this->board->_move, 'move color did not increment');
        $this->assertEquals(2, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not reset');
    }
    
    function test_castleqw()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $this->board->_BCastleQ = $this->board->_BCastleK = true;
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_enPassantSquare = 'e3';
        $err = $this->board->addPiece('W', 'R', 'a1');
        $this->assertFalse(is_object($err), 'adding W rook failed');
        $err = $this->board->addPiece('W', 'K', 'e1');
        $this->assertFalse(is_object($err), 'adding W king failed');
        $err = $this->board->moveSAN('O-O-O');
        $this->assertFalse(is_object($err), 'castling kingside failed');
        if (is_object($err)) {
            $this->assertEquals($err->message,'');
        }
        $this->assertTrue($this->board->_BCastleQ, 'BQ cleared');
        $this->assertTrue($this->board->_BCastleK, 'BK cleared');
        $this->assertFalse($this->board->_WCastleQ, 'WQ not cleared');
        $this->assertFalse($this->board->_WCastleK, 'WK not cleared');
        $this->assertEquals(7, $this->board->_halfMoves, 'half moves did not increment');
        $this->assertEquals('B', $this->board->_move, 'move color did not increment');
        $this->assertEquals(1, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not reset');
    }
    
    function test_castleqb()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->_WCastleQ = $this->board->_WCastleK = true;
        $this->board->_BCastleQ = $this->board->_BCastleK = true;
        $this->board->_halfMoves = 6;
        $this->board->_moveNumber = 1;
        $this->board->_enPassantSquare = 'e3';
        $this->board->_move = 'B';
        $err = $this->board->addPiece('B', 'R', 'a8');
        $this->assertFalse(is_object($err), 'adding B rook failed');
        $err = $this->board->addPiece('B', 'K', 'e8');
        $this->assertFalse(is_object($err), 'adding B king failed');
        $err = $this->board->moveSAN('O-O-O');
        $this->assertFalse(is_object($err), 'castling kingside failed');
        if (is_object($err)) {
            $this->assertEquals($err->message,'');
        }
        $this->assertTrue($this->board->_WCastleQ, 'WQ cleared');
        $this->assertTrue($this->board->_WCastleK, 'WK cleared');
        $this->assertFalse($this->board->_BCastleQ, 'BQ not cleared');
        $this->assertFalse($this->board->_BCastleK, 'BK not cleared');
        $this->assertEquals(7, $this->board->_halfMoves, 'half moves did not increment');
        $this->assertEquals('W', $this->board->_move, 'move color did not increment');
        $this->assertEquals(2, $this->board->_moveNumber, 'move number changed');
        $this->assertEquals('-', $this->board->_enPassantSquare, 'en passant not reset');
    }
}

?>
