--TEST--
Games_Chess->_getKnightSquares() e4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKnightSquares('e4');
$phpunit->assertEquals(array (
  'WNW' => 'c5',
  'NNW' => 'd6',
  'NNE' => 'f6',
  'ENE' => 'g5',
  'ESE' => 'g3',
  'SSE' => 'f2',
  'SSW' => 'd2',
  'WSW' => 'c3',
), $ret, 'Incorrect knight squares 2');
echo 'tests done';
?>
--EXPECT--
tests done