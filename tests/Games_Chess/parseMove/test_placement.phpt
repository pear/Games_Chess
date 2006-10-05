--TEST--
Games_Chess->_parseMove() placement move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('P@a2');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEPLACEMENT =>
    array(
        'piece' => 'P',
        'square' => 'a2'
    )), $ret, 'P@a2');
$ret = $board->_parseMove('Q@h7');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEPLACEMENT =>
    array(
        'piece' => 'Q',
        'square' => 'h7'
    )), $ret, 'Q@h7');
$ret = $board->_parseMove('B@f8');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEPLACEMENT =>
    array(
        'piece' => 'B',
        'square' => 'f8'
    )), $ret, 'B@f8');
$ret = $board->_parseMove('N@g3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEPLACEMENT =>
    array(
        'piece' => 'N',
        'square' => 'g3'
    )), $ret, 'P@a2');
$ret = $board->_parseMove('R@b1');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEPLACEMENT =>
    array(
        'piece' => 'R',
        'square' => 'b1'
    )), $ret, 'R@b1');
echo 'tests done';
?>
--EXPECT--
tests done