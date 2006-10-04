--TEST--
Games_Chess->_getKingSquares() e4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKingSquares('e4');
$phpunit->assertEquals(array('d4', 'd5', 'd3', 'f4', 'f5', 'f3', 'e3', 'e5'),
    $ret, 'Incorrect king squares');
echo 'tests done';
?>
--EXPECT--
tests done