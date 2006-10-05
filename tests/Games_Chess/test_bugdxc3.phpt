--TEST--
Games_Chess dxc3 bug
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->moveSAN('e4');
$board->moveSAN('e5');
$board->moveSAN('Nf3');
$board->moveSAN('Nc6');
$board->moveSAN('Bc4');
$board->moveSAN('Nf6');
$board->moveSAN('Nc3');
$board->moveSAN('Bb4');
$board->moveSAN('a3');
$board->moveSAN('Bxc3');
$err = $board->moveSAN('dxc3');
$phpunit->assertTrue($err, 1);
$board->resetGame();
$board->moveSAN('e4');
$board->moveSAN('e5');
$board->moveSAN('Nf3');
$board->moveSAN('Nc6');
$board->moveSAN('Bc4');
$board->moveSAN('Nf6');
$board->moveSAN('Nc3');
$board->moveSAN('Bb4');
$board->moveSAN('a3');
$board->moveSAN('Bxc3');
$err = $board->moveSquare('d2', 'c3');
$phpunit->assertTrue($err, 2);
echo 'tests done';
?>
--EXPECT--
tests done