--TEST--
Games_Chess->getMoveList() checkmate
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->moveSAN('e4');
$board->moveSAN('g5');
$board->moveSAN('Qf3');
$board->moveSAN('f5');
$board->moveSAN('Qh5');
$phpunit->assertEquals(
    array (
  1 => 
  array (
    0 => 'e4',
    1 => 'g5',
  ),
  2 => 
  array (
    0 => 'Qf3',
    1 => 'f5',
  ),
  3 => 
  array (
    0 => 'Qh5',
  ),
),
    $board->getMoveList(), 'basic move list is wrong');
$phpunit->assertEquals(
    array (
  1 => 
  array (
    0 => 'e4',
    1 => 'g5',
  ),
  2 => 
  array (
    0 => 'Qf3',
    1 => 'f5',
  ),
  3 => 
  array (
    0 => 'Qh5#',
  ),
),
    $board->getMoveList(true), 'checked move list is wrong');
echo 'tests done';
?>
--EXPECT--
tests done