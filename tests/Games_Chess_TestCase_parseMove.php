<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_parseMove extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_parseMove($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->board = new Games_Chess_Standard();
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
        $this->assertTrue(false, "$errstr at line $errline");
    }
    
    function test_pawnmove_valid1()
    {
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        $ret = $this->board->_parseMove('a1');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => '',
                'takes' => '',
                'disambiguate' => '',
                'square' => 'a1',
                'promote' => '',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Pa1');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => '',
                'takes' => '',
                'disambiguate' => '',
                'square' => 'a1',
                'promote' => '',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
    }
    
    function test_pawnmove_validpromote()
    {
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        $ret = $this->board->_parseMove('a1=Q');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => '',
                'takes' => '',
                'disambiguate' => '',
                'square' => 'a1',
                'promote' => 'Q',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('h8=Q');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => '',
                'takes' => '',
                'disambiguate' => '',
                'square' => 'h8',
                'promote' => 'Q',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Pa1=Q');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => '',
                'takes' => '',
                'disambiguate' => '',
                'square' => 'a1',
                'promote' => 'Q',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Ph8=Q');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => '',
                'takes' => '',
                'disambiguate' => '',
                'square' => 'h8',
                'promote' => 'Q',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
    }
    
    function test_pawnmove_validcapture()
    {
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        $ret = $this->board->_parseMove('axb6');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => 'a',
                'takes' => 'x',
                'disambiguate' => '',
                'square' => 'b6',
                'promote' => '',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Paxb6');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => 'a',
                'takes' => 'x',
                'disambiguate' => '',
                'square' => 'b6',
                'promote' => '',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
    }
    
    function test_pawnmove_validcapturepromote()
    {
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        $ret = $this->board->_parseMove('axb8=R');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => 'a',
                'takes' => 'x',
                'disambiguate' => '',
                'square' => 'b8',
                'promote' => 'R',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Paxb8=R');
        $this->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
                'takesfrom' => 'a',
                'takes' => 'x',
                'disambiguate' => '',
                'square' => 'b8',
                'promote' => 'R',
                'piece' => 'P',
            )), $ret, 'incorrect parsing');
    }
    
    function test_piecemove_valid()
    {
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        $ret = $this->board->_parseMove('Nc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'N',
                'disambiguate' => '',
                'takes' => '',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Rc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'R',
                'disambiguate' => '',
                'takes' => '',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Qc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'Q',
                'disambiguate' => '',
                'takes' => '',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Bc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'B',
                'disambiguate' => '',
                'takes' => '',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Kc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'K',
                'disambiguate' => '',
                'takes' => '',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
    }
    
    function test_piecemove_validmove_disambiguate()
    {
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        $ret = $this->board->_parseMove('Qac3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'Q',
                'disambiguate' => 'a',
                'takes' => '',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Q1c3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'Q',
                'disambiguate' => '1',
                'takes' => '',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        // rare occasion
        $ret = $this->board->_parseMove('Na1c2');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'N',
                'disambiguate' => 'a1',
                'takes' => '',
                'square' => 'c2',
            )), $ret, 'incorrect parsing');
    }
    
    function test_piecemove_validcapture()
    {
        if (!$this->_methodExists('_parseMove')) {
            return;
        }
        $ret = $this->board->_parseMove('Qxc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'Q',
                'disambiguate' => '',
                'takes' => 'x',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Nxc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'N',
                'disambiguate' => '',
                'takes' => 'x',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Bxc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'B',
                'disambiguate' => '',
                'takes' => 'x',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Kxc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'K',
                'disambiguate' => '',
                'takes' => 'x',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Rxc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'R',
                'disambiguate' => '',
                'takes' => 'x',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('R1xc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'R',
                'disambiguate' => '1',
                'takes' => 'x',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        $ret = $this->board->_parseMove('Raxc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'R',
                'disambiguate' => 'a',
                'takes' => 'x',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
        // rare occasion
        $ret = $this->board->_parseMove('Na2xc3');
        $this->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
                'takesfrom' => false,
                'piece' => 'N',
                'disambiguate' => 'a2',
                'takes' => 'x',
                'square' => 'c3',
            )), $ret, 'incorrect parsing');
    }
    
    function test_castle()
    {
        $ret = $this->board->_parseMove('O-O');
        $this->assertEquals(array(GAMES_CHESS_CASTLE => 'K'), $ret,
            'incorrect parsing');
        $ret = $this->board->_parseMove('O-O-O');
        $this->assertEquals(array(GAMES_CHESS_CASTLE => 'Q'), $ret,
            'incorrect parsing');
    }
    
    function test_pawnmove_invalid1()
    {
        $ret = $this->board->_parseMove('a9');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"a9" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_pawnmove_invalid2()
    {
        $ret = $this->board->_parseMove('q8');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"q8" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_pawnmove_invalid3()
    {
        $ret = $this->board->_parseMove('aa8');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"aa8" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_pawnmove_invalid4()
    {
        $ret = $this->board->_parseMove('a88');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"a88" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_pawnmove_invalid5()
    {
        $ret = $this->board->_parseMove('qxh8');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"qxh8" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_pawnmove_invalid6()
    {
        $ret = $this->board->_parseMove('axj8');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"axj8" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_pawnmove_invalid7()
    {
        $ret = $this->board->_parseMove('h8=K');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"h8=K" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_piecemove_invalid1()
    {
        $ret = $this->board->_parseMove('Qj4');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"Qj4" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_piecemove_invalid2()
    {
        $ret = $this->board->_parseMove('Lf4');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"Lf4" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_piecemove_invalid3()
    {
        $ret = $this->board->_parseMove('Kxu4');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"Kxu4" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
    
    function test_piecemove_invalid4()
    {
        $ret = $this->board->_parseMove('Kaxh4');
        $this->assertEquals('pear_error', get_class($ret), 'no error');
        $this->assertEquals('"Kaxh4" is not a valid algebraic move', $ret->getMessage(),
            'invalid error message');
    }
}

?>
