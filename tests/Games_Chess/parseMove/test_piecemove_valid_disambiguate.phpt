--TEST--
Games_Chess->_parseMove() valid piece move (disambiguating)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_parseMove('Qac3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'Q',
        'disambiguate' => 'a',
        'takes' => '',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
$ret = $board->_parseMove('Q1c3');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'Q',
        'disambiguate' => '1',
        'takes' => '',
        'square' => 'c3',
    )), $ret, 'incorrect parsing');
// rare occasion
$ret = $board->_parseMove('Na1c2');
$phpunit->assertEquals(array(GAMES_CHESS_PIECEMOVE => array(
        'takesfrom' => false,
        'piece' => 'N',
        'disambiguate' => 'a1',
        'takes' => '',
        'square' => 'c2',
    )), $ret, 'incorrect parsing');
echo 'tests done';
?>
--EXPECT--
tests done