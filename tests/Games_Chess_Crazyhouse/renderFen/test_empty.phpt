--TEST--
Games_Chess_Crazyhouse->_renderFen() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals('8/8/8/8/8/8/8/8', $board->_renderFen(), 1);
echo 'tests done';
?>
--EXPECT--
tests done