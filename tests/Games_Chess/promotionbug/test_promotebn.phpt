--TEST--
Games_Chess promotion bug - to knight (black)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('rnbqkbnr/pppp1ppp/8/8/8/5N2/PPPPP1pP/RNBQKB1R b KQkq - 2 5');
$phpunit->assertEquals(array('g2', 'P'), $board->_pieces['BP8'], 'pawn 1 wrong');
$err = $board->moveSAN('gxh1=N');
$phpunit->assertTrue($err, 1);
$phpunit->assertEquals(array('h1', 'N'), $board->_pieces['BP8'], 'promotion failed');
echo 'tests done';
?>
--EXPECT--
tests done