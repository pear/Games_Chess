--TEST--
Games_Chess->_parseMove() valid pawn promotion
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('a1=Q');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'a1',
        'promote' => 'Q',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('a1Q');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'a1',
        'promote' => 'Q',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('h8=Q');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'h8',
        'promote' => 'Q',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('h8Q');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'h8',
        'promote' => 'Q',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Pa1=Q');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'a1',
        'promote' => 'Q',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Pa1Q');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'a1',
        'promote' => 'Q',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Ph8=Q');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'h8',
        'promote' => 'Q',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Ph8Q');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => '',
        'takes' => '',
        'disambiguate' => '',
        'square' => 'h8',
        'promote' => 'Q',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
echo 'tests done';
?>
--EXPECT--
tests done