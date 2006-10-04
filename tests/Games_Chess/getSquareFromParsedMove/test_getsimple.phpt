--TEST--
Games_Chess->_getSquareFromParsedMove() simple move tests
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('rnbqkbnr/1pp1p2p/2P5/p2P1ppQ/8/8/PP1P1PP1/RNB1KBNR w KQkq - 2 6');
$a = $board->_parseMove('Qh4');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('h5', $err, 'wrong queen square');
$a = $board->_parseMove('Nf3');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('g1', $err, 'wrong knight square');
$a = $board->_parseMove('Be2');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('f1', $err, 'wrong bishop square');
$board->_pieces['WP8'] = false;
$a = $board->_parseMove('Rh2');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('h1', $err, 'wrong rook square');
$a = $board->_parseMove('Ke2');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('e1', $err, 'wrong king square');
$a = $board->_parseMove('g4');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertEquals('g2', $err, 'wrong pawn square');
echo 'tests done';
?>
--EXPECT--
tests done