--TEST--
Games_Chess->_getKingSquares() h1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKingSquares('h1');
$phpunit->assertEquals(array('g1', 'g2', 'h2'),
    $ret, 'Incorrect king squares');
echo 'tests done';
?>
--EXPECT--
tests done