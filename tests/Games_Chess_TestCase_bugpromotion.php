<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_bugpromotion extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_bugpromotion($name)
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
    
    function test_promotewQ()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/ppppp1Pp/8/8/8/8/PPPP1PPP/RNBQKBNR w KQkq - 2 5');
        $this->assertEquals(array('g7', 'P'), $this->board->_pieces['WP1'], 'pawn 1 wrong');
        $err = $this->board->moveSAN('gxh8=Q');
        $this->assertFalse(is_object($err));
        $this->assertEquals(array('h8', 'Q'), $this->board->_pieces['WP1'], 'promotion failed');
    }
    
    function test_promotewR()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/ppppp1Pp/8/8/8/8/PPPP1PPP/RNBQKBNR w KQkq - 2 5');
        $this->assertEquals(array('g7', 'P'), $this->board->_pieces['WP1'], 'pawn 1 wrong');
        $err = $this->board->moveSAN('gxh8=R');
        $this->assertFalse(is_object($err));
        $this->assertEquals(array('h8', 'R'), $this->board->_pieces['WP1'], 'promotion failed');
    }
    
    function test_promotewB()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/ppppp1Pp/8/8/8/8/PPPP1PPP/RNBQKBNR w KQkq - 2 5');
        $this->assertEquals(array('g7', 'P'), $this->board->_pieces['WP1'], 'pawn 1 wrong');
        $err = $this->board->moveSAN('gxh8=B');
        $this->assertFalse(is_object($err));
        $this->assertEquals(array('h8', 'B'), $this->board->_pieces['WP1'], 'promotion failed');
    }
    
    function test_promotewN()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/ppppp1Pp/8/8/8/8/PPPP1PPP/RNBQKBNR w KQkq - 2 5');
        $this->assertEquals(array('g7', 'P'), $this->board->_pieces['WP1'], 'pawn 1 wrong');
        $err = $this->board->moveSAN('gxh8=N');
        $this->assertFalse(is_object($err));
        $this->assertEquals(array('h8', 'N'), $this->board->_pieces['WP1'], 'promotion failed');
    }
    
    function test_promotebQ()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/pppp1ppp/8/8/8/5N2/PPPPP1pP/RNBQKB1R b KQkq - 2 5');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['BP8'], 'pawn 1 wrong');
        $err = $this->board->moveSAN('gxh1=Q');
        $this->assertFalse(is_object($err));
        $this->assertEquals(array('h1', 'Q'), $this->board->_pieces['BP8'], 'promotion failed');
    }
    
    function test_promotebR()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/pppp1ppp/8/8/8/5N2/PPPPP1pP/RNBQKB1R b KQkq - 2 5');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['BP8'], 'pawn 1 wrong');
        $err = $this->board->moveSAN('gxh1=R');
        $this->assertFalse(is_object($err));
        $this->assertEquals(array('h1', 'R'), $this->board->_pieces['BP8'], 'promotion failed');
    }
    
    function test_promotebB()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/pppp1ppp/8/8/8/5N2/PPPPP1pP/RNBQKB1R b KQkq - 2 5');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['BP8'], 'pawn 1 wrong');
        $err = $this->board->moveSAN('gxh1=B');
        $this->assertFalse(is_object($err));
        $this->assertEquals(array('h1', 'B'), $this->board->_pieces['BP8'], 'promotion failed');
    }
    
    function test_promotebN()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame('rnbqkbnr/pppp1ppp/8/8/8/5N2/PPPPP1pP/RNBQKB1R b KQkq - 2 5');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['BP8'], 'pawn 1 wrong');
        $err = $this->board->moveSAN('gxh1=N');
        $this->assertFalse(is_object($err));
        $this->assertEquals(array('h1', 'N'), $this->board->_pieces['BP8'], 'promotion failed');
    }
}

?>
