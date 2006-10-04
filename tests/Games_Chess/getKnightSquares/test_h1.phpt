--TEST--
Games_Chess->_getKnightSquares() h1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKnightSquares('h1');
$phpunit->assertEquals(array (
  'WNW' => 'f2',
  'NNW' => 'g3',
), $ret, 'Incorrect knight squares 2');
echo 'tests done';
?>
--EXPECT--
tests done