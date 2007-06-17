--TEST--
Games_Chess->_parseMove() valid pawn capture => promotion
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('axb8=R');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => 'a',
        'takes' => 'x',
        'disambiguate' => '',
        'square' => 'b8',
        'promote' => 'R',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('axb8R');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => 'a',
        'takes' => 'x',
        'disambiguate' => '',
        'square' => 'b8',
        'promote' => 'R',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Paxb8=R');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => 'a',
        'takes' => 'x',
        'disambiguate' => '',
        'square' => 'b8',
        'promote' => 'R',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Paxb8R');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => 'a',
        'takes' => 'x',
        'disambiguate' => '',
        'square' => 'b8',
        'promote' => 'R',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
echo 'tests done';
?>
--EXPECT--
tests done