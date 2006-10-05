--TEST--
Games_Chess en passant bug test
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'b5');
$board->addPiece('B', 'P', 'a5');
$board->_enPassantSquare = 'a6';
$phpunit->assertEquals(array('a5', 'P'), $board->_pieces['BP1'], 1);
$board->moveSAN('bxa6');
$phpunit->assertFalse($board->_pieces['BP1'], 2);
$phpunit->assertEquals(array('a6', 'P'), $board->_pieces['WP1'], 'piece wrong');
$phpunit->assertEquals('a5', $board->_board['a5'], 'board square wrong');
echo 'tests done';
?>
--EXPECT--
tests done