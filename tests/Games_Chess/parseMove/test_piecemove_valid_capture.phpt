--TEST--
Games_Chess->_parseMove() valid piece move (disambiguating)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('Qxc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'Q',
        'disambiguate' => '',
        'takes' => 'x',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Nxc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'N',
        'disambiguate' => '',
        'takes' => 'x',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Bxc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'B',
        'disambiguate' => '',
        'takes' => 'x',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Kxc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'K',
        'disambiguate' => '',
        'takes' => 'x',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Rxc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'R',
        'disambiguate' => '',
        'takes' => 'x',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('R1xc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'R',
        'disambiguate' => '1',
        'takes' => 'x',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Raxc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'R',
        'disambiguate' => 'a',
        'takes' => 'x',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
// rare occasion
$ret = $board->_parseMove('Na2xc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'N',
        'disambiguate' => 'a2',
        'takes' => 'x',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
echo 'tests done';
?>
--EXPECT--
tests done