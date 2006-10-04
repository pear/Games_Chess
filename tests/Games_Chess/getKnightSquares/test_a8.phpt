--TEST--
Games_Chess->_getKnightSquares() a8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKnightSquares('a8');
$phpunit->assertEquals(array (
  'ESE' => 'c7',
  'SSE' => 'b6',
), $ret, 'Incorrect knight squares 2');
echo 'tests done';
?>
--EXPECT--
tests done