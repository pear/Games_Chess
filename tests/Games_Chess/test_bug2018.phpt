--TEST--
Games_Chess bug #2018
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('rnk2Bn1/p1p1Ppp1/bp6/1P6/6r1/7p/P1PP1PPP/RN2K1NR w KQ - 0 0');
$board->moveSAN('e8=Q');
$board->moveSAN('Kb7');
$board->moveSAN('bxa6');
$board->moveSAN('Kxa6');
$board->moveSAN('Bb4');
$board->moveSAN('Rg5');
$board->moveSAN('a4');
$board->moveSAN('Rg6');
$board->moveSAN('a5');
$board->moveSAN('Rg5');
$board->moveSAN('Qc8');
$phpunit->assertTrue(true, 'error returned');
echo 'tests done';
?>
--EXPECT--
tests done