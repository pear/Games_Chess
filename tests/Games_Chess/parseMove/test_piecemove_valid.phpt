--TEST--
Games_Chess->_parseMove() valid piece move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('Nc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'N',
        'disambiguate' => '',
        'takes' => '',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Rc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'R',
        'disambiguate' => '',
        'takes' => '',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Qc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'Q',
        'disambiguate' => '',
        'takes' => '',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Bc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'B',
        'disambiguate' => '',
        'takes' => '',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Kc3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'K',
        'disambiguate' => '',
        'takes' => '',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
echo 'tests done';
?>
--EXPECT--
tests done