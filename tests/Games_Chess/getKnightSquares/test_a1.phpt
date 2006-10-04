--TEST--
Games_Chess->_getKnightSquares() a1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKnightSquares('a1', true);
$phpunit->assertEquals(array('b3', 'c2'),
    $ret, 'Incorrect knight squares true');
$ret = $board->_getKnightSquares('a1');
$phpunit->assertEquals(array (
  'NNE' => 'b3',
  'ENE' => 'c2',
), $ret, 'Incorrect knight squares 2');
echo 'tests done';
?>
--EXPECT--
tests done