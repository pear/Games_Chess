--TEST--
Games_Chess->_getKnightSquares() h8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKnightSquares('h8');
$phpunit->assertEquals(array (
  'SSW' => 'g6',
  'WSW' => 'f7',
), $ret, 'Incorrect knight squares 2');
echo 'tests done';
?>
--EXPECT--
tests done