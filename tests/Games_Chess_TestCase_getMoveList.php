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

class Games_Chess_TestCase_getMoveList extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getMoveList($name)
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

    function test_valid_check()
    {
        if (!$this->_methodExists('inCheck')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame();
        $this->board->moveSAN('e4');
        $this->board->moveSAN('f5');
        $this->board->moveSAN('Qh5');
        $this->assertEquals(
            array(1=> array('e4', 'f5'), 2 => array('Qh5')),
            $this->board->getMoveList(), 'basic move list is wrong');
        $this->assertEquals(
            array(1=> array('e4', 'f5'), 2 => array('Qh5+')),
            $this->board->getMoveList(true), 'checked move list is wrong');
    }

    function test_valid_checkmate()
    {
        if (!$this->_methodExists('inCheck')) {
            return;
        }
        if (!$this->_methodExists('resetGame')) {
            return;
        }
        if (!$this->_methodExists('moveSAN')) {
            return;
        }
        $this->board->resetGame();
        $this->board->moveSAN('e4');
        $this->board->moveSAN('g5');
        $this->board->moveSAN('Qf3');
        $this->board->moveSAN('f5');
        $this->board->moveSAN('Qh5');
        $this->assertEquals(
            array(1=> array('e4', 'g5'), 2 => array('Qf3', 'f5'), 3 => array('Qh5')),
            $this->board->getMoveList(), 'basic move list is wrong');
        $this->assertEquals(
            array(1=> array('e4', 'g5'), 2 => array('Qf3', 'f5'), 3 => array('Qh5#')),
            $this->board->getMoveList(true), 'checked move list is wrong');
    }
}

?>
