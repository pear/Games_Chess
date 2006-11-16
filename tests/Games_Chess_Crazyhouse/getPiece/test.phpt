--TEST--
Games_Chess_Crazyhouse->_getPiece()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e3');
$board->addPiece('B', 'K', 'e5');
$phpunit->assertEquals(false, $board->_getPiece('WP1'), 'WP1 1');
$phpunit->assertEquals('e3', $board->_getPiece('WK0'), 'WK0 1');
$phpunit->assertEquals('e5', $board->_getPiece('BK0'), 'BK0 1');

$board->resetGame();
$phpunit->assertEquals('a1', $board->_getPiece('WR0'), 'WR0');
$phpunit->assertEquals('b1', $board->_getPiece('WN0'), 'WN0');
$phpunit->assertEquals('c1', $board->_getPiece('WB0'), 'WB0');
$phpunit->assertEquals('d1', $board->_getPiece('WQ0'), 'WQ0');
$phpunit->assertEquals('e1', $board->_getPiece('WK0'), 'WK0');
$phpunit->assertEquals('f1', $board->_getPiece('WB1'), 'WB1');
$phpunit->assertEquals('g1', $board->_getPiece('WN1'), 'WN1');
$phpunit->assertEquals('h1', $board->_getPiece('WR1'), 'WR1');
$phpunit->assertEquals(false, $board->_getPiece('WR2'), 'WR2');
$phpunit->assertEquals(false, $board->_getPiece('WN2'), 'WN2');
$phpunit->assertEquals(false, $board->_getPiece('WB2'), 'WB2');
$phpunit->assertEquals(false, $board->_getPiece('WQ1'), 'WQ1');
$phpunit->assertEquals(false, $board->_getPiece('WK1'), 'WK1');

$phpunit->assertEquals('a8', $board->_getPiece('BR0'), 'BR0');
$phpunit->assertEquals('b8', $board->_getPiece('BN0'), 'BN0');
$phpunit->assertEquals('c8', $board->_getPiece('BB0'), 'BB0');
$phpunit->assertEquals('d8', $board->_getPiece('BQ0'), 'BQ0');
$phpunit->assertEquals('e8', $board->_getPiece('BK0'), 'BK0');
$phpunit->assertEquals('f8', $board->_getPiece('BB1'), 'BB1');
$phpunit->assertEquals('g8', $board->_getPiece('BN1'), 'BN1');
$phpunit->assertEquals('h8', $board->_getPiece('BR1'), 'BR1');
$phpunit->assertEquals(false, $board->_getPiece('BR2'), 'BR2');
$phpunit->assertEquals(false, $board->_getPiece('BN2'), 'BN2');
$phpunit->assertEquals(false, $board->_getPiece('BB2'), 'BB2');
$phpunit->assertEquals(false, $board->_getPiece('BQ1'), 'BQ1');
$phpunit->assertEquals(false, $board->_getPiece('BK1'), 'BK1');

$board->blankBoard();
$board->addPiece('W', 'B', 'c1');
$board->addPiece('W', 'B', 'f1');

$board->addPiece('W', 'P', 'a2');
$board->addPiece('W', 'P', 'b2');
$board->addPiece('W', 'P', 'c2');
$board->addPiece('W', 'P', 'd2');
$board->addPiece('W', 'P', 'e2');
$board->addPiece('W', 'P', 'f2');
$board->addPiece('W', 'P', 'g2');
$board->addPiece('W', 'P', 'h2');

// capture and place the enemy bishops as well
$board->addPiece('W', 'B', 'c8');
$board->addPiece('W', 'B', 'f8');

$phpunit->assertEquals('c1', $board->_getPiece('WB0'), 'WB0');
$phpunit->assertEquals('f1', $board->_getPiece('WB1'), 'WB1');
$phpunit->assertEquals('c8', $board->_getPiece('WB2'), 'WB2');
$phpunit->assertEquals('f8', $board->_getPiece('WB3'), 'WB3');
$phpunit->assertEquals(false, $board->_getPiece('WB4'), 'WB4');

$board->blankBoard();
$board->addPiece('W', 'B', 'c1');
$board->addPiece('W', 'B', 'f1');

$board->addPiece('W', 'P', 'b2');
$board->addPiece('W', 'P', 'c2');
$board->addPiece('W', 'P', 'd2');
$board->addPiece('W', 'P', 'e2');
$board->addPiece('W', 'P', 'f2');
$board->addPiece('W', 'P', 'g2');
$board->addPiece('W', 'P', 'h2');

// capture and place the enemy bishops as well
$board->addPiece('W', 'B', 'c8');
$board->addPiece('W', 'B', 'f8');
$board->addPiece('W', 'B', 'g1');

$phpunit->assertEquals('c1', $board->_getPiece('WB0'), 'WB0');
$phpunit->assertEquals('f1', $board->_getPiece('WB1'), 'WB1');
$phpunit->assertEquals('c8', $board->_getPiece('WP7'), 'WP7');
$phpunit->assertEquals('f8', $board->_getPiece('WB2'), 'WB2');
$phpunit->assertEquals('g1', $board->_getPiece('WB3'), 'WB3');
$phpunit->assertEquals(false, $board->_getPiece('WB4'), 'WB4');
echo 'tests done';
?>
--EXPECT--
tests done