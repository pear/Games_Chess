--TEST--
Games_Chess->inCheckMate() Bug #7565 - checkmate because of pinned interposing piece
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('1r2k3/p1pbb1p1/2p5/5p1r/N1Q5/5N2/PPP2PPP/R3R1K1 w - - 2 20');
$board->moveSAN('Qg8');
$phpunit->assertTrue($board->inCheckmate('B'), 'B');
$phpunit->assertFalse($board->inCheckmate('W'), 'W');
echo 'tests done';
?>
--EXPECT--
tests done