--TEST--
Games_Chess_Crazyhouse->moveSAN() place piece
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$board->moveSAN('e4');
$board->moveSAN('d5');
$board->moveSAN('exd5');
$board->moveSAN('Qxd5');
$err = $board->moveSAN('P@e4');
$phpunit->assertTrue($err, 'P@e4');
$board->moveSAN('Nf6');
$board->moveSAN('exd5');
$err = $board->moveSAN('P@e4'); // try black
$phpunit->assertTrue($err, 'P@e4 black');
$err = $board->moveSAN('Q@e3');
$phpunit->assertTrue($err, 'Q@e3');
$board->moveSAN('Nc6');
$board->moveSAN('dxc6');
$board->moveSAN('e6');
$board->moveSAN('cxb7');
$board->moveSAN('Bxb7');
$err = $board->moveSAN('P@a4');
$phpunit->assertTrue($err, 'P@a4');
$board->moveSAN('h6');
$err = $board->moveSAN('P@h5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no captured Black Pawns available to place')
), 'error 1');
$phpunit->assertEquals(GAMES_CHESS_ERROR_NOPIECES_TOPLACE, $err->getCode(), 'no place code');
echo 'tests done';
?>
--EXPECT--
tests done