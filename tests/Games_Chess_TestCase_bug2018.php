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

class Games_Chess_TestCase_validMove extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_validMove($name)
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
    
    function test_bug2018()
    {
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        $this->board->resetGame('rnk2Bn1/p1p1Ppp1/bp6/1P6/6r1/7p/P1PP1PPP/RN2K1NR w KQ - 0 0');
        $this->board->moveSAN('e8=Q');
        $this->board->moveSAN('Kb7');
        $this->board->moveSAN('bxa6');
        $this->board->moveSAN('Kxa6');
        $this->board->moveSAN('Bb4');
        $this->board->moveSAN('Rg5');
        $this->board->moveSAN('a4');
        $this->board->moveSAN('Rg6');
        $this->board->moveSAN('a5');
        $this->board->moveSAN('Rg5');
        $this->board->moveSAN('Qc8');
    }
}

?>
