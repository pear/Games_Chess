--TEST--
Games_Chess->_parseMove() valid pawn capture
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('axb6');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => 'a',
        'takes' => 'x',
        'disambiguate' => '',
        'square' => 'b6',
        'promote' => '',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Paxb6');
$phpunit->assertEquals(array(GAMES_CHESS_PAWNMOVE => array(
        'takesfrom' => 'a',
        'takes' => 'x',
        'disambiguate' => '',
        'square' => 'b6',
        'promote' => '',
        'piece' => 'P',
    )), $ret, 'incorrect parsing');
echo 'tests done';
?>
--EXPECT--
tests done