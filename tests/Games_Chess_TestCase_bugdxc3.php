<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

class Games_Chess_TestCase_bugdxc3 extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_bugdxc3($name)
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
    
    function test_dxc3()
    {
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame();
        $this->board->moveSAN('e4');
        $this->board->moveSAN('e5');
        $this->board->moveSAN('Nf3');
        $this->board->moveSAN('Nc6');
        $this->board->moveSAN('Bc4');
        $this->board->moveSAN('Nf6');
        $this->board->moveSAN('Nc3');
        $this->board->moveSAN('Bb4');
        $this->board->moveSAN('a3');
        $this->board->moveSAN('Bxc3');
        $err = $this->board->moveSAN('dxc3');
        $this->assertFalse(is_object($err));
        $this->board->resetGame();
        $this->board->moveSAN('e4');
        $this->board->moveSAN('e5');
        $this->board->moveSAN('Nf3');
        $this->board->moveSAN('Nc6');
        $this->board->moveSAN('Bc4');
        $this->board->moveSAN('Nf6');
        $this->board->moveSAN('Nc3');
        $this->board->moveSAN('Bb4');
        $this->board->moveSAN('a3');
        $this->board->moveSAN('Bxc3');
        $err = $this->board->moveSquare('d2', 'c3');
        $this->assertFalse(is_object($err));
    }
}

?>
