<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_addPiece extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_addPiece($name)
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
        $this->assertTrue(false, "$errstr at line $errline");
    }
    
    function test_addbishopw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'B', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['WB1'],
            'incorrect bishop setup');
        $this->board->addPiece('W', 'B', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['WB1'],
            'first bishop changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['WB2'],
            'incorrect bishop setup');
        $this->board->addPiece('W', 'B', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['WB1'],
            'first bishop changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['WB2'],
            'second bishop changed, should not change');
        $this->assertEquals(array('h1', 'B'), $this->board->_pieces['WP1']);
    }
    
    function test_addbishopb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'B', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['BB1'],
            'incorrect bishop setup');
        $this->board->addPiece('B', 'B', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['BB1'],
            'first bishop changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['BB2'],
            'incorrect bishop setup');
        $this->board->addPiece('B', 'B', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['BB1'],
            'first bishop changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['BB2'],
            'second bishop changed, should not change');
        $this->assertEquals(array('h1', 'B'), $this->board->_pieces['BP1']);
    }
    
    function test_addknightw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'N', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['WN1'],
            'incorrect knight setup');
        $this->board->addPiece('W', 'N', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['WN1'],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['WN2'],
            'incorrect knight setup');
        $this->board->addPiece('W', 'N', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['WN1'],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['WN2'],
            'second knight changed, should not change');
        $this->assertEquals(array('h1', 'N'), $this->board->_pieces['WP1']);
    }
    
    function test_addknightb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'N', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['BN1'],
            'incorrect knight setup');
        $this->board->addPiece('B', 'N', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['BN1'],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['BN2'],
            'incorrect knight setup');
        $this->board->addPiece('B', 'N', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['BN1'],
            'first knight changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['BN2'],
            'second knight changed, should not change');
        $this->assertEquals(array('h1', 'N'), $this->board->_pieces['BP1']);
    }
    
    function test_addrookw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'R', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['WR1'],
            'incorrect rook setup');
        $this->board->addPiece('W', 'R', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['WR1'],
            'first rook changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['WR2'],
            'incorrect rook setup');
        $this->board->addPiece('W', 'R', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['WR1'],
            'first rook changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['WR2'],
            'second rook changed, should not change');
        $this->assertEquals(array('h1', 'R'), $this->board->_pieces['WP1']);
    }
    
    function test_addrookb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'R', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['BR1'],
            'incorrect rook setup');
        $this->board->addPiece('B', 'R', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['BR1'],
            'first rook changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['BR2'],
            'incorrect rook setup');
        $this->board->addPiece('B', 'R', 'h1');
        $this->assertEquals('a1', $this->board->_pieces['BR1'],
            'first rook changed, should not change');
        $this->assertEquals('g1', $this->board->_pieces['BR2'],
            'second rook changed, should not change');
        $this->assertEquals(array('h1', 'R'), $this->board->_pieces['BP1']);
    }
    
    function test_addqueenw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'Q', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['WQ'],
            'incorrect queen setup');
        $this->board->addPiece('W', 'Q', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['WQ'],
            'first queen changed, should not change');
        $this->assertEquals(array('g1', 'Q'), $this->board->_pieces['WP1']);
    }
    
    function test_addqueenb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'Q', 'a1');
        $this->assertEquals('a1', $this->board->_pieces['BQ'],
            'incorrect queen setup');
        $this->board->addPiece('B', 'Q', 'g1');
        $this->assertEquals('a1', $this->board->_pieces['BQ'],
            'first queen changed, should not change');
        $this->assertEquals(array('g1', 'Q'), $this->board->_pieces['BP1']);
    }
    
    function test_addpawnsw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('W', 'P', 'a2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['WP1'],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'a3');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['WP1'],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['WP2'],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'b2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['WP1'],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['WP2'],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['WP3'],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'c2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['WP1'],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['WP2'],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['WP3'],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['WP4'],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'd2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['WP1'],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['WP2'],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['WP3'],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['WP4'],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['WP5'],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'e2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['WP1'],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['WP2'],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['WP3'],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['WP4'],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['WP5'],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['WP6'],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'f2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['WP1'],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['WP2'],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['WP3'],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['WP4'],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['WP5'],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['WP6'],
            '6 pawn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['WP7'],
            'incorrect pawn setup');
        $this->board->addPiece('W', 'P', 'g2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['WP1'],
            '1 pawn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['WP2'],
            '2 pawn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['WP3'],
            '3 pawn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['WP4'],
            '4 pawn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['WP5'],
            '5 pawn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['WP6'],
            '6 pawn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['WP7'],
            '7 pawn not the same');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['WP8'],
            'incorrect pawn setup');
    }
    
    function test_addpawnsb()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->addPiece('B', 'P', 'a2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['BP1'],
            'incorrect paBn setup');
        $this->board->addPiece('B', 'P', 'a3');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['BP1'],
            '1 paBn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['BP2'],
            'incorrect paBn setup');
        $this->board->addPiece('B', 'P', 'b2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['BP1'],
            '1 paBn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['BP2'],
            '2 paBn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['BP3'],
            'incorrect paBn setup');
        $this->board->addPiece('B', 'P', 'c2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['BP1'],
            '1 paBn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['BP2'],
            '2 paBn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['BP3'],
            '3 paBn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['BP4'],
            'incorrect paBn setup');
        $this->board->addPiece('B', 'P', 'd2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['BP1'],
            '1 paBn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['BP2'],
            '2 paBn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['BP3'],
            '3 paBn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['BP4'],
            '4 paBn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['BP5'],
            'incorrect paBn setup');
        $this->board->addPiece('B', 'P', 'e2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['BP1'],
            '1 paBn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['BP2'],
            '2 paBn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['BP3'],
            '3 paBn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['BP4'],
            '4 paBn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['BP5'],
            '5 paBn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['BP6'],
            'incorrect paBn setup');
        $this->board->addPiece('B', 'P', 'f2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['BP1'],
            '1 paBn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['BP2'],
            '2 paBn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['BP3'],
            '3 paBn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['BP4'],
            '4 paBn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['BP5'],
            '5 paBn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['BP6'],
            '6 paBn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['BP7'],
            'incorrect paBn setup');
        $this->board->addPiece('B', 'P', 'g2');
        $this->assertEquals(array('a2', 'P'), $this->board->_pieces['BP1'],
            '1 paBn not the same');
        $this->assertEquals(array('a3', 'P'), $this->board->_pieces['BP2'],
            '2 paBn not the same');
        $this->assertEquals(array('b2', 'P'), $this->board->_pieces['BP3'],
            '3 paBn not the same');
        $this->assertEquals(array('c2', 'P'), $this->board->_pieces['BP4'],
            '4 paBn not the same');
        $this->assertEquals(array('d2', 'P'), $this->board->_pieces['BP5'],
            '5 paBn not the same');
        $this->assertEquals(array('e2', 'P'), $this->board->_pieces['BP6'],
            '6 paBn not the same');
        $this->assertEquals(array('f2', 'P'), $this->board->_pieces['BP7'],
            '7 paBn not the same');
        $this->assertEquals(array('g2', 'P'), $this->board->_pieces['BP8'],
            'incorrect paBn setup');
    }
    
    function test_invalid_toomanyw()
    {
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        for($i=0; $i<8; $i++) {
            $err = $this->board->addPiece('W', 'P', 'g' . ($i + 1));
            $this->assertSame($err, true, $i);
        }
        $err = $this->board->addPiece('W', 'P', 'a4');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many White Pawns', $err->getMessage(), 'wrong message');
        
        $err = $this->board->addPiece('W', 'Q', 'a4');
        $this->assertSame($err, true, 'Qa4');
        $err = $this->board->addPiece('W', 'Q', 'a5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many White Queens', $err->getMessage(), 'wrong message');
        
        $err = $this->board->addPiece('W', 'R', 'a6');
        $this->assertSame($err, true, 'Ra6');
        $err = $this->board->addPiece('W', 'R', 'a7');
        $this->assertSame($err, true, 'Ra7');
        $err = $this->board->addPiece('W', 'R', 'a5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many White Rooks', $err->getMessage(), 'wrong message');
        
        $err = $this->board->addPiece('W', 'N', 'b6');
        $this->assertSame($err, true, 'Nb6');
        $err = $this->board->addPiece('W', 'N', 'b7');
        $this->assertSame($err, true, 'Nb7');
        $err = $this->board->addPiece('W', 'N', 'b5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many White Knights', $err->getMessage(), 'wrong message');
        
        $err = $this->board->addPiece('W', 'B', 'c6');
        $this->assertSame($err, true, 'Bc6');
        $err = $this->board->addPiece('W', 'B', 'c7');
        $this->assertSame($err, true, 'Bc7');
        $err = $this->board->addPiece('W', 'B', 'c5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many White Bishops', $err->getMessage(), 'wrong message');
        
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
        for($i=0; $i<8; $i++) {
            $err = $this->board->addPiece('B', 'P', 'g' . ($i + 1));
            $this->assertSame($err, true, $i);
        }
        $err = $this->board->addPiece('B', 'P', 'a4');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many Black Pawns', $err->getMessage(), 'Wrong message');
        
        $err = $this->board->addPiece('B', 'Q', 'a4');
        $this->assertSame($err, true, 'Qa4');
        $err = $this->board->addPiece('B', 'Q', 'a5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many Black Queens', $err->getMessage(), 'Wrong message');
        
        $err = $this->board->addPiece('B', 'R', 'a6');
        $this->assertSame($err, true, 'Ra6');
        $err = $this->board->addPiece('B', 'R', 'a7');
        $this->assertSame($err, true, 'Ra7');
        $err = $this->board->addPiece('B', 'R', 'a5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many Black Rooks', $err->getMessage(), 'Wrong message');
        
        $err = $this->board->addPiece('B', 'N', 'b6');
        $this->assertSame($err, true, 'Nb6');
        $err = $this->board->addPiece('B', 'N', 'b7');
        $this->assertSame($err, true, 'Nb7');
        $err = $this->board->addPiece('B', 'N', 'b5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many Black Knights', $err->getMessage(), 'Wrong message');
        
        $err = $this->board->addPiece('B', 'B', 'c6');
        $this->assertSame($err, true, 'Bc6');
        $err = $this->board->addPiece('B', 'B', 'c7');
        $this->assertSame($err, true, 'Bc7');
        $err = $this->board->addPiece('B', 'B', 'c5');
        $this->assertEquals('pear_error', strtolower(get_class($err)), 'not an error!');
        $this->assertEquals('Too many Black Bishops', $err->getMessage(), 'Wrong message');
        
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
