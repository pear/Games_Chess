--TEST--
Games_Chess_Crazyhouse->_takePiece()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'e1');
$board->addPiece('B', 'R', 'e2');
$phpunit->assertEquals('8/8/8/8/8/8/4r3/4R3', $board->_renderFen(), 1);
$phpunit->assertEquals(array (
  'W' => 
  array (
    'P' => 0,
    'B' => 0,
    'N' => 0,
    'Q' => 0,
    'R' => 0,
  ),
  'B' => 
  array (
    'P' => 0,
    'B' => 0,
    'N' => 0,
    'Q' => 0,
    'R' => 0,
  ),
), $board->_captured, 'cap 1');
$board->_moveAlgebraic('e1', 'e2');
$phpunit->assertEquals('8/8/8/8/8/8/4R3/8', $board->_renderFen(), 2);
$phpunit->assertEquals(array (
  'W' => 
  array (
    'P' => 0,
    'B' => 0,
    'N' => 0,
    'Q' => 0,
    'R' => 1,
  ),
  'B' => 
  array (
    'P' => 0,
    'B' => 0,
    'N' => 0,
    'Q' => 0,
    'R' => 0,
  ),
), $board->_captured, 'cap 2');

$board->blankBoard();
$board->addPiece('W', 'R', 'e1');
$board->addPiece('B', 'R', 'd3');
$board->addPiece('B', 'R', 'e4');
$board->addPiece('B', 'R', 'e2');
$phpunit->assertEquals('8/8/8/8/4r3/3r4/4r3/4R3', $board->_renderFen(), 1);
$phpunit->assertEquals(array (
  'W' => 
  array (
    'P' => 0,
    'B' => 0,
    'N' => 0,
    'Q' => 0,
    'R' => 0,
  ),
  'B' => 
  array (
    'P' => 0,
    'B' => 0,
    'N' => 0,
    'Q' => 0,
    'R' => 0,
  ),
), $board->_captured, 'cap 1');
$board->_moveAlgebraic('e1', 'e2');
$phpunit->assertEquals('8/8/8/8/4r3/3r4/4R3/8', $board->_renderFen(), 2);
$phpunit->assertEquals(array (
  'W' => 
  array (
    'P' => 1,
    'B' => 0,
    'N' => 0,
    'Q' => 0,
    'R' => 0,
  ),
  'B' => 
  array (
    'P' => 0,
    'B' => 0,
    'N' => 0,
    'Q' => 0,
    'R' => 0,
  ),
), $board->_captured, 'cap 2');
echo 'tests done';
?>
--EXPECT--
tests done