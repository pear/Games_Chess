--TEST--
Games_Chess->_getKingSquares() a1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKingSquares('a1');
$phpunit->assertEquals(array('b1', 'b2', 'a2'),
    $ret, 'Incorrect king squares');
echo 'tests done';
?>
--EXPECT--
tests done