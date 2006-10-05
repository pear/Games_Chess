--TEST--
Games_Chess->_parseMove() castling
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('O-O');
$phpunit->assertEquals(array(GAMES_CHESS_CASTLE => 'K'), $ret,
    'incorrect parsing');
$ret = $board->_parseMove('O-O-O');
$phpunit->assertEquals(array(GAMES_CHESS_CASTLE => 'Q'), $ret,
    'incorrect parsing');
echo 'tests done';
?>
--EXPECT--
tests done