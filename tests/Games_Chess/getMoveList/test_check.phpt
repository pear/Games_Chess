--TEST--
Games_Chess->getMoveList() check
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->moveSAN('e4');
$board->moveSAN('f5');
$board->moveSAN('Qh5');
$phpunit->assertEquals(
    array(1=> array('e4', 'f5'), 2 => array('Qh5')),
    $board->getMoveList(), 'basic move list is wrong');
$phpunit->assertEquals(
    array(1=> array('e4', 'f5'), 2 => array('Qh5+')),
    $board->getMoveList(true), 'checked move list is wrong');
echo 'tests done';
?>
--EXPECT--
tests done