<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_getCastleSquares extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getCastleSquares($name)
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
    
    function test_getCastleSquares_w()
    {
        if (!$this->_methodExists('_getCastleSquares')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        for ($i = ord('a'); $i <= ord('h'); $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $ret = $this->board->_getCastleSquares(chr($i) . $j);
                if (chr($i) . $j == 'e1') {
                    $this->assertEquals(array('g1', 'c1'),
                       $ret, 'Incorrect castle squares ' . chr($i) . $j);
                } else {
                    $this->assertEquals(array(),
                        $ret, 'Incorrect castle squares ' . chr($i) . $j);
                }
            }
        }
    }
    
    function test_getCastleSquares_b()
    {
        if (!$this->_methodExists('_getCastleSquares')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame();
        $this->board->_move = 'B';
        for ($i = ord('a'); $i <= ord('h'); $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $ret = $this->board->_getCastleSquares(chr($i) . $j);
                if (chr($i) . $j == 'e8') {
                    $this->assertEquals(array('g8', 'c8'),
                       $ret, 'Incorrect castle squares ' . chr($i) . $j);
                } else {
                    $this->assertEquals(array(),
                        $ret, 'Incorrect castle squares ' . chr($i) . $j);
                }
            }
        }
    }
}
?>
