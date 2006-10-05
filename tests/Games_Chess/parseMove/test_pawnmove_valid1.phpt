--TEST--
Games_Chess->_parseMove() valid pawn move #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('a1');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'a1',
        'promote' => '',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Pa1');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'a1',
        'promote' => '',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
echo 'tests done';
?>
--EXPECT--
tests done