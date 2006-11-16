--TEST--
Games_Chess_Crazyhouse->moveSAN() place piece on invalid square
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->moveSAN('P@d5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There are no captured Black Pawns available to place')
), 'error 1');
$phpunit->assertEquals(GAMES_CHESS_ERROR_NOPIECES_TOPLACE, $err->getCode(), 'err 1');
$phpunit->assertEquals('pear_error', strtolower(get_class($err)), 'no error');
$board->moveSAN('e4');
$board->moveSAN('d5');
$board->moveSAN('exd5');
$board->moveSAN('Qxd5');
$err = $board->moveSAN('P@d5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'There is already a piece on d5, cannot place another there')
), 'error 2');
$phpunit->assertEquals(GAMES_CHESS_ERROR_PIECEINTHEWAY, $err->getCode(), 'err 2');
echo 'tests done';
?>
--EXPECT--
tests done