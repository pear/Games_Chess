<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_Crazyhouse_TestCase_addPiece extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_Crazyhouse_TestCase_addPiece($name)
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
        $this->assertTrue(false, "$errstr at line $errline");
    }
    
    function test_addbishopw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['W']['B'][0],
            'incorrect bishop setup');
        $this->board->addPiece('W', 'B', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['W']['B'][0],
            'first bishop changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['W']['B'][1],
            'incorrect bishop setup');
        $this->board->addPiece('W', 'B', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['W']['B'][0],
            'first bishop changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['W']['B'][1],
            'first bishop changed, should not change');
        $this->assertEquals('h1', $this->board->_pieces['W']['B'][2],
            'incorrect bishop setup');
    }
    
    function test_addbishopb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'B', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['B']['B'][0],
            'incorrect bishop setup');
        $this->board->addPiece('B', 'B', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['B']['B'][0],
            'first bishop changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['B']['B'][1],
            'incorrect bishop setup');
        $this->board->addPiece('B', 'B', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['B']['B'][0],
            'first bishop changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['B']['B'][1],
            'first bishop changed, should not change');
        $this->assertEquals('h1', $this->board->_pieces['B']['B'][2],
            'incorrect bishop setup');
    }
    
    function test_addknightw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['W']['N'][0],
            'incorrect knight setup');
        $this->board->addPiece('W', 'N', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['W']['N'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['W']['N'][1],
            'incorrect knight setup');
        $this->board->addPiece('W', 'N', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['W']['N'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['W']['N'][1],
            'second knight changed, should not change');
        $this->assertEquals('h1', $this->board->_pieces['W']['N'][2],
            'incorrect knight setup');
    }
    
    function test_addknightb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'N', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['B']['N'][0],
            'incorrect knight setup');
        $this->board->addPiece('B', 'N', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['B']['N'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['B']['N'][1],
            'incorrect knight setup');
        $this->board->addPiece('B', 'N', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['B']['N'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['B']['N'][1],
            'second knight changed, should not change');
        $this->assertEquals('h1', $this->board->_pieces['B']['N'][2],
            'incorrect knight setup');
    }
    
    function test_addrookw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['W']['R'][0],
            'incorrect knight setup');
        $this->board->addPiece('W', 'R', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['W']['R'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['W']['R'][1],
            'incorrect knight setup');
        $this->board->addPiece('W', 'R', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['W']['R'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['W']['R'][1],
            'second knight changed, should not change');
        $this->assertEquals('h1', $this->board->_pieces['W']['R'][2],
            'incorrect knight setup');
    }
    
    function test_addrookb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['B']['R'][0],
            'incorrect knight setup');
        $this->board->addPiece('B', 'R', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['B']['R'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['B']['R'][1],
            'incorrect knight setup');
        $this->board->addPiece('B', 'R', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['B']['R'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['B']['R'][1],
            'second knight changed, should not change');
        $this->assertEquals('h1', $this->board->_pieces['B']['R'][2],
            'incorrect knight setup');
    }
    
    function test_addqueenw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['W']['Q'][0],
            'incorrect knight setup');
        $this->board->addPiece('W', 'Q', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['W']['Q'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['W']['Q'][1],
            'incorrect knight setup');
        $this->board->addPiece('W', 'Q', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['W']['Q'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['W']['Q'][1],
            'second knight changed, should not change');
        $this->assertEquals('h1', $this->board->_pieces['W']['Q'][2],
            'incorrect knight setup');
    }
    
    function test_addqueenb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['B']['Q'][0],
            'incorrect knight setup');
        $this->board->addPiece('B', 'Q', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['B']['Q'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['B']['Q'][1],
            'incorrect knight setup');
        $this->board->addPiece('B', 'Q', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['B']['Q'][0],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['B']['Q'][1],
            'second knight changed, should not change');
        $this->assertEquals('h1', $this->board->_pieces['B']['Q'][2],
            'incorrect knight setup');
    }
    
    function test_addpawnsw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'a2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'a3');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['W']['P'][1],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'b2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['W']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['W']['P'][2],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'c2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['W']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['W']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['W']['P'][3],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'd2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['W']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['W']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['W']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['W']['P'][4],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'e2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['W']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['W']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['W']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['W']['P'][4],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['W']['P'][5],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'f2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['W']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['W']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['W']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['W']['P'][4],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['W']['P'][5],
            '6 pawn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['W']['P'][6],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'g2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['W']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['W']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['W']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['W']['P'][4],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['W']['P'][5],
            '6 pawn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['W']['P'][6],
            '7 pawn not the same');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['W']['P'][7],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'g3');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['W']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['W']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['W']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['W']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['W']['P'][4],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['W']['P'][5],
            '6 pawn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['W']['P'][6],
            '7 pawn not the same');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['W']['P'][7],
            '8 pawn not the same');
        $this->assertEquals(array('g3', 'P'), $this->board->_pieces['W']['P'][8],
            'incorrect pawn setup');
    }
    
    function test_addpawnsb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'P', 'a2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            'incorrect pawn setup');
        $this->board->addPiece('B', 'P', 'a3');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['B']['P'][1],
            'incorrect pawn setup');
        $this->board->addPiece('B', 'P', 'b2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['B']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['B']['P'][2],
            'incorrect pawn setup');
        $this->board->addPiece('B', 'P', 'c2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['B']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['B']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['B']['P'][3],
            'incorrect pawn setup');
        $this->board->addPiece('B', 'P', 'd2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['B']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['B']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['B']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['B']['P'][4],
            'incorrect pawn setup');
        $this->board->addPiece('B', 'P', 'e2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['B']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['B']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['B']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['B']['P'][4],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['B']['P'][5],
            'incorrect pawn setup');
        $this->board->addPiece('B', 'P', 'f2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['B']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['B']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['B']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['B']['P'][4],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['B']['P'][5],
            '6 pawn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['B']['P'][6],
            'incorrect pawn setup');
        $this->board->addPiece('B', 'P', 'g2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['B']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['B']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['B']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['B']['P'][4],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['B']['P'][5],
            '6 pawn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['B']['P'][6],
            '7 pawn not the same');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['B']['P'][7],
            'incorrect pawn setup');
        $this->board->addPiece('B', 'P', 'g3');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['B']['P'][0],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['B']['P'][1],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['B']['P'][2],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['B']['P'][3],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['B']['P'][4],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['B']['P'][5],
            '6 pawn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['B']['P'][6],
            '7 pawn not the same');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['B']['P'][7],
            '8 pawn not the same');
        $this->assertEquals(array('g3', 'P'), $this->board->_pieces['B']['P'][8],
            'incorrect pawn setup');
    }
    
    function test_invalid_toomanyw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $err = $this->board->addPiece('W', 'K', 'd6');
        $this->assertSame($err, true, 'Kd6');
        $err = $this->board->addPiece('W', 'K', 'c5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many White Kings', $err->getMessage(), 'wrong message');
    }
    
    function test_invalid_toomanyb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $err = $this->board->addPiece('B', 'K', 'd6');
        $this->assertSame($err, true, 'Kd6');
        $err = $this->board->addPiece('B', 'K', 'c5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many Black Kings', $err->getMessage(), 'Wrong message');
    }
    
    function test_invalid_dupepiece()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $err = $this->board->addPiece('W', 'P', 'a4');
        $this->assertSame($err, true, 'Pa4');
        $err = $this->board->addPiece('B', 'P', 'a4');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Pawn already occupies square a4, cannot be replaced by Pawn',
            $err->getMessage(), 'Wrong message');

        $err = $this->board->addPiece('W', 'N', 'a5');
        $this->assertSame($err, true, 'Pa4');
        $err = $this->board->addPiece('B', 'B', 'a5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Knight already occupies square a5, cannot be replaced by Bishop',
            $err->getMessage(), 'Wrong message');
    }
}

?>
