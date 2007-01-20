--TEST--
Games_Chess repetition draw detection
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->moveSAN('Nf3');
$board->moveSAN('e6');
// 2
$board->moveSAN('Nc3');
$board->moveSAN('Qe7');
// 3
$board->moveSAN('e4');
$board->moveSAN('Qd8');
// 4
$board->moveSAN('d4');
$board->moveSAN('Qe7');
// 5
$board->moveSAN('Be3');
$board->moveSAN('Qd8');
// 6
$board->moveSAN('Bd3');
$board->moveSAN('Qe7');
// 7
$board->moveSAN('Qd2');
$board->moveSAN('Qd8');
// 8
$board->moveSAN('e5');
$board->moveSAN('Qh4');
// 9
$board->moveSAN('O-O-O');
$board->moveSAN('d5');
// 10
$board->moveSAN('Ng1');
$board->moveSAN('Qd8');
// 11
$board->moveSAN('Nf3');
$board->moveSAN('Qh4');
// 12
$board->moveSAN('Ng1');
$board->moveSAN('Qd8');
// 13
$board->moveSAN('Nf3');
$board->moveSAN('Qh4');

$phpunit->assertNoErrors('test 1');
$phpunit->assertFalse($board->inRepetitionDraw(), 'draw 1');
// 14
$board->moveSAN('Ng1');
$board->moveSAN('Qd8');
// 15
$board->moveSAN('Nf3');
$board->moveSAN('Qh4');

$phpunit->assertNoErrors('test 1');
$phpunit->assertTrue($board->inRepetitionDraw(), 'draw 1.5');

$board->resetGame();
//1.e4 Na6 2.Bxa6 b6 3.Bxc8 a6 4.Bb7 Rb8 5.Bc8 Ra8 6.Bb7 Rb8
$board->moveSAN('e4');
$board->moveSAN('Na6');
// 2
$board->moveSAN('Bxa6');
$board->moveSAN('b6');
// 3
$board->moveSAN('Bxc8');
$board->moveSAN('a6');
// 4
$board->moveSAN('Bb7');
$board->moveSAN('Rb8');
// 5
$board->moveSAN('Bc8');
$board->moveSAN('Ra8');
// 6
$board->moveSAN('Bb7');
$board->moveSAN('Rb8');

$phpunit->assertNoErrors('test 2');
$phpunit->assertFalse($board->inRepetitionDraw(), 'draw 2');
// 7
$board->moveSAN('Bc8');
$board->moveSAN('Ra8');
// 8
$board->moveSAN('Bb7');
$board->moveSAN('Rb8');
$phpunit->assertNoErrors('test 2.5');
$phpunit->assertTrue($board->inRepetitionDraw(), 'draw 2.5');
echo 'tests done';
?>
--EXPECT--
tests done