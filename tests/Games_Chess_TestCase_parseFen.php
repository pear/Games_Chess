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
class Games_Chess_testStandard extends Games_Chess_Standard {
    var $pieces = array();
    function addPiece($color, $type, $square)
    {
        $this->pieces[] = array($color, $type, $square);
    }
}
/**
 * @package Games_Chess
 */

class Games_Chess_TestCase_parseFen extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_parseFen($name)
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
    
    function test_invalid1()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('hello');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "hello" has 1 fields, 6 is required', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid2()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('1 2 3 4  5');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "1 2 3 4  5" has an empty field at index 4', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid3()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('1$ 2 3 4 5 6');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "1$ 2 3 4 5 6" the character "$" is not a valid piece, separator or number', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid4()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('RKQBPRNNRQ 2 3 4 5 6');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "RKQBPRNNRQ 2 3 4 5 6" has too many pieces for a chessboard', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid5()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('RKQBPRNN/RQ 2 3 4 5 6');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "RKQBPRNN/RQ 2 3 4 5 6" has too few pieces for a chessboard', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid6()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR 2 3 4 5 6');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR 2 3 4 5 6" has invalid to-move indicator, must be "w" or "b"', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid7()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w QKQKQ 4 5 6');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w QKQKQ 4 5 6" the castling indicator (KQkq) is too long', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid8()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w QKqw 4 5 6');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w QKqw 4 5 6" the castling indicator "w" is invalid', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid9()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq 4 5 6');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq 4 5 6" the en passant square indicator "4" is invalid', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid10()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - a 6');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - a 6" the half-move ply count "a" is not a number', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid11()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 5 a');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 5 a" the move number "a" is not a number', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid12()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkppp/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 5 5');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "rnbqkppp/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 5 5" Too many Black Pawns', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid13()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQk d1 0 1');
        $this->assertEquals('pear_error', get_class($err), 'not an error');
        $this->assertEquals('Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQk d1 0 1" the en passant square indicator "d1" is invalid', $err->getMessage(), 'wrong message');
    }
    
    function test_valid1()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQk d3 0 1');
        $this->assertSame(true, $err, 'not valid parse');
        $this->assertTrue($this->board->_WCastleQ);
        $this->assertTrue($this->board->_WCastleK);
        $this->assertFalse(false, $this->board->_BCastleQ);
        $this->assertTrue($this->board->_BCastleK);
        $this->assertEquals('B', $this->board->_move);
        $this->assertEquals('d3', $this->board->_enPassantSquare, 'wrong en passant');
        $this->assertEquals(0, $this->board->_halfMoves, 'wrong ply count');
        $this->assertEquals(1, $this->board->_moveNumber, 'wrong ply count');
    }
    
    function test_valid2()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w Kkq d6 5 12');
        $this->assertTrue($err, 'not valid parse');
        $this->assertFalse($this->board->_WCastleQ);
        $this->assertTrue($this->board->_WCastleK);
        $this->assertTrue($this->board->_BCastleQ);
        $this->assertTrue($this->board->_BCastleK);
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w Qkq d6 5 12');
        $this->assertTrue($err, 'not valid parse');
        $this->assertTrue($this->board->_WCastleQ);
        $this->assertFalse($this->board->_WCastleK);
        $this->assertTrue($this->board->_BCastleQ);
        $this->assertTrue($this->board->_BCastleK);
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w kq d6 5 12');
        $this->assertTrue($err, 'not valid parse');
        $this->assertFalse($this->board->_WCastleQ);
        $this->assertFalse($this->board->_WCastleK);
        $this->assertTrue($this->board->_BCastleQ);
        $this->assertTrue($this->board->_BCastleK);
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w q d6 5 12');
        $this->assertTrue($err, 'not valid parse');
        $this->assertFalse($this->board->_WCastleQ);
        $this->assertFalse($this->board->_WCastleK);
        $this->assertTrue($this->board->_BCastleQ);
        $this->assertFalse($this->board->_BCastleK);
        $err = $this->board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w - d6 5 12');
        $this->assertTrue($err, 'not valid parse');
        $this->assertFalse($this->board->_WCastleQ);
        $this->assertFalse($this->board->_WCastleK);
        $this->assertFalse($this->board->_BCastleQ);
        $this->assertFalse($this->board->_BCastleK);
    }
    
    function test_valid_fenboard1()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $newboard = new Games_Chess_testStandard;
        $err = $newboard->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w Qkq d6 5 12');
        $this->assertSame(true, $err, 'not valid parse');
        $this->assertEquals(
            array(
                array('B', 'R', 'a8'),
                array('B', 'N', 'b8'),
                array('B', 'B', 'c8'),
                array('B', 'Q', 'd8'),
                array('B', 'K', 'e8'),
                array('B', 'B', 'f8'),
                array('B', 'N', 'g8'),
                array('B', 'R', 'h8'),

                array('B', 'P', 'a7'),
                array('B', 'P', 'b7'),
                array('B', 'P', 'c7'),
                array('B', 'P', 'd7'),
                array('B', 'P', 'e7'),
                array('B', 'P', 'f7'),
                array('B', 'P', 'g7'),
                array('B', 'P', 'h7'),

                array('W', 'P', 'a2'),
                array('W', 'P', 'b2'),
                array('W', 'P', 'c2'),
                array('W', 'P', 'd2'),
                array('W', 'P', 'e2'),
                array('W', 'P', 'f2'),
                array('W', 'P', 'g2'),
                array('W', 'P', 'h2'),

                array('W', 'R', 'a1'),
                array('W', 'N', 'b1'),
                array('W', 'B', 'c1'),
                array('W', 'Q', 'd1'),
                array('W', 'K', 'e1'),
                array('W', 'B', 'f1'),
                array('W', 'N', 'g1'),
                array('W', 'R', 'h1'),
            ),
            $newboard->pieces, 'incorrect board setup');
    }
    
    function test_valid_fenboard2()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $newboard = new Games_Chess_testStandard;
        $err = $newboard->_parseFen('rnbqkbn1/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w Qkq d6 5 12');
        $this->assertSame(true, $err, 'not valid parse');
        $this->assertEquals(
            array(
                array('B', 'R', 'a8'),
                array('B', 'N', 'b8'),
                array('B', 'B', 'c8'),
                array('B', 'Q', 'd8'),
                array('B', 'K', 'e8'),
                array('B', 'B', 'f8'),
                array('B', 'N', 'g8'),

                array('B', 'P', 'a7'),
                array('B', 'P', 'b7'),
                array('B', 'P', 'c7'),
                array('B', 'P', 'd7'),
                array('B', 'P', 'e7'),
                array('B', 'P', 'f7'),
                array('B', 'P', 'g7'),
                array('B', 'P', 'h7'),

                array('W', 'P', 'a2'),
                array('W', 'P', 'b2'),
                array('W', 'P', 'c2'),
                array('W', 'P', 'd2'),
                array('W', 'P', 'e2'),
                array('W', 'P', 'f2'),
                array('W', 'P', 'g2'),
                array('W', 'P', 'h2'),

                array('W', 'R', 'a1'),
                array('W', 'N', 'b1'),
                array('W', 'B', 'c1'),
                array('W', 'Q', 'd1'),
                array('W', 'K', 'e1'),
                array('W', 'B', 'f1'),
                array('W', 'N', 'g1'),
                array('W', 'R', 'h1'),
            ),
            $newboard->pieces, 'incorrect board setup');
    }

    function test_valid_fenboard3()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $newboard = new Games_Chess_testStandard;
        $err = $newboard->_parseFen('rnbqkbn1/pppppppp/5r2/8/8/8/PPPPPPPP/RNBQKBNR w Qkq d6 5 12');
        $this->assertSame(true, $err, 'not valid parse');
        $this->assertEquals(
            array(
                array('B', 'R', 'a8'),
                array('B', 'N', 'b8'),
                array('B', 'B', 'c8'),
                array('B', 'Q', 'd8'),
                array('B', 'K', 'e8'),
                array('B', 'B', 'f8'),
                array('B', 'N', 'g8'),

                array('B', 'P', 'a7'),
                array('B', 'P', 'b7'),
                array('B', 'P', 'c7'),
                array('B', 'P', 'd7'),
                array('B', 'P', 'e7'),
                array('B', 'P', 'f7'),
                array('B', 'P', 'g7'),
                array('B', 'P', 'h7'),

                array('B', 'R', 'f6'),

                array('W', 'P', 'a2'),
                array('W', 'P', 'b2'),
                array('W', 'P', 'c2'),
                array('W', 'P', 'd2'),
                array('W', 'P', 'e2'),
                array('W', 'P', 'f2'),
                array('W', 'P', 'g2'),
                array('W', 'P', 'h2'),

                array('W', 'R', 'a1'),
                array('W', 'N', 'b1'),
                array('W', 'B', 'c1'),
                array('W', 'Q', 'd1'),
                array('W', 'K', 'e1'),
                array('W', 'B', 'f1'),
                array('W', 'N', 'g1'),
                array('W', 'R', 'h1'),
            ),
            $newboard->pieces, 'incorrect board setup');
    }

    function test_valid_fenboard4()
    {
        if (!$this->_methodExists('_parseFen')) {
            return;
        }
        $err = $this->board->_parseFen('rnbqkbn1/pppppppp/5r2/8/8/8/PPPPPPPP/RNBQKBNR w Qkq d6 5 12');
        $this->assertSame(true, $err, 'not valid parse');
        $this->assertEquals(
            array(
                'WR1' => 'a1',
                'WN1' => 'b1',
                'WB1' => 'c1',
                'WQ' => 'd1',
                'WK' => 'e1',
                'WB2' => 'f1',
                'WN2' => 'g1',
                'WR2' => 'h1',

                'WP1' => array('a2','P'),
                'WP2' => array('b2','P'),
                'WP3' => array('c2','P'),
                'WP4' => array('d2','P'),
                'WP5' => array('e2','P'),
                'WP6' => array('f2','P'),
                'WP7' => array('g2','P'),
                'WP8' => array('h2','P'),

                'BP1' => array('a7','P'),
                'BP2' => array('b7','P'),
                'BP3' => array('c7','P'),
                'BP4' => array('d7','P'),
                'BP5' => array('e7','P'),
                'BP6' => array('f7','P'),
                'BP7' => array('g7','P'),
                'BP8' => array('h7','P'),

                'BR1' => 'a8',
                'BN1' => 'b8',
                'BB1' => 'c8',
                'BQ' => 'd8',
                'BK' => 'e8',
                'BB2' => 'f8',
                'BN2' => 'g8',
                'BR2' => 'f6',
            ),
            $this->board->_pieces, 'incorrect board setup');
    }
}

?>
