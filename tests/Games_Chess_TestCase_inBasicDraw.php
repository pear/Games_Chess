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

class Games_Chess_TestCase_inBasicDraw extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_inBasicDraw($name)
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
    
    function test_kingsonly()
    {
        if (!$this->_methodExists('inBasicDraw')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->blankboard();
        $this->board->addPiece('W', 'K', 'a1');
        $this->board->addPiece('B', 'K', 'h1');
        $this->assertTrue($this->board->inBasicDraw());
    }
    
    function test_kkb()
    {
        if (!$this->_methodExists('inBasicDraw')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->blankboard();
        $this->board->addPiece('W', 'K', 'a1');
        $this->board->addPiece('B', 'K', 'h1');
        $this->board->addPiece('B', 'B', 'h2');
        $this->assertTrue($this->board->inBasicDraw());
    }
    
    function test_kkn()
    {
        if (!$this->_methodExists('inBasicDraw')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->blankboard();
        $this->board->addPiece('W', 'K', 'a1');
        $this->board->addPiece('B', 'K', 'h1');
        $this->board->addPiece('B', 'N', 'h2');
        $this->assertTrue($this->board->inBasicDraw());
    }
    
    function test_kkbb_valid()
    {
        if (!$this->_methodExists('inBasicDraw')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->blankboard();
        $this->board->addPiece('W', 'K', 'a4');
        $this->board->addPiece('W', 'B', 'a1');
        $this->board->addPiece('B', 'K', 'h1');
        $this->board->addPiece('B', 'B', 'h2');
        $this->assertTrue($this->board->inBasicDraw());
    }
    
    function test_kkbb_invalid()
    {
        if (!$this->_methodExists('inBasicDraw')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->blankboard();
        $this->board->addPiece('W', 'K', 'a4');
        $this->board->addPiece('W', 'B', 'a1');
        $this->board->addPiece('B', 'K', 'a8');
        $this->board->addPiece('B', 'B', 'h1');
        $this->assertFalse($this->board->inBasicDraw());
    }
    
    function test_invalid2()
    {
        if (!$this->_methodExists('inBasicDraw')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->blankboard();
        $this->board->addPiece('W', 'K', 'a4');
        $this->board->addPiece('W', 'B', 'a1');
        $this->board->addPiece('W', 'B', 'b1');
        $this->board->addPiece('B', 'K', 'h8');
        $this->board->addPiece('B', 'B', 'h1');
        $this->assertFalse($this->board->inBasicDraw());
    }
    
    function test_invalid3()
    {
        if (!$this->_methodExists('inBasicDraw')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->blankboard();
        $this->board->addPiece('W', 'K', 'a4');
        $this->board->addPiece('W', 'B', 'a1');
        $this->board->addPiece('B', 'B', 'b1');
        $this->board->addPiece('B', 'K', 'h8');
        $this->board->addPiece('B', 'B', 'h1');
        $this->assertFalse($this->board->inBasicDraw());
    }
}

?>
