--TEST--
Games_Chess->_getKingSquares() h8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getKingSquares('h8');
$phpunit->assertEquals(array('g8', 'g7', 'h7'),
    $ret, 'Incorrect king squares');
echo 'tests done';
?>
--EXPECT--
tests done