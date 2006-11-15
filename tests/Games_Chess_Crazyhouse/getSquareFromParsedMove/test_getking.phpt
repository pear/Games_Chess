--TEST--
Games_Chess_Crazyhouse->_getSquareFromParsedMove() get king
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('rnbqkbnr/1pp1p2p/2P5/p2P1ppQ/8/8/PP1P1PPP/RNB1KBNR w KQkq - 2 6');
$a = $board->_parseMove('Kd1');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('e1', $err, 'wrong king square');
$err = $board->resetGame('rnbqkbnr/1pp1p2p/2P5/p2P1ppQ/8/8/PP1P1PPP/RNB1KBNR b KQkq - 2 6');
$a = $board->_parseMove('Kf7');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('e8', $err, 'wrong king square');
echo 'tests done';
?>
--EXPECT--
tests done