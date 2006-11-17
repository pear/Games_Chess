--TEST--
Games_Chess_Crazyhouse->_renderFen() starting position
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$phpunit->assertEquals('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR', $board->_renderFen(), 1);
echo 'tests done';
?>
--EXPECT--
tests done