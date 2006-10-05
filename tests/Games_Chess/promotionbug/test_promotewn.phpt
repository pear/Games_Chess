--TEST--
Games_Chess promotion bug - to knight (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('rnbqkbnr/ppppp1Pp/8/8/8/8/PPPP1PPP/RNBQKBNR w KQkq - 2 5');
$phpunit->assertEquals(array('g7', 'P'), $board->_pieces['WP1'], 'pawn 1 wrong');
$err = $board->moveSAN('gxh8=N');
$phpunit->assertTrue($err, 1);
$phpunit->assertEquals(array('h8', 'N'), $board->_pieces['WP1'], 'promotion failed');
echo 'tests done';
?>
--EXPECT--
tests done