--TEST--
Games_Chess->inCheck() in check
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('8/pppppppp/8/rnbqkbnr/8/RNBQKBNR/PPPPPPPP/8 w KQkq - 0 1');
$pieces = $board->inCheck('W');
$phpunit->assertEquals(
    'c5',
    $pieces, 'black checking is wrong');
$pieces = $board->inCheck('B');
$phpunit->assertEquals(
    'c3',
    $pieces, 'white checking is wrong');

echo 'tests done';
?>
--EXPECT--
tests done