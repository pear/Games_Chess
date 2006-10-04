--TEST--
Games_Chess->_parseFen() valid #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w Kkq d6 5 12');
$phpunit->assertTrue($err, 'not valid parse');
$phpunit->assertFalse($board->_WCastleQ, '_WCastleQ 1');
$phpunit->assertTrue($board->_WCastleK, '_WCastleK 1');
$phpunit->assertTrue($board->_BCastleQ, '_BCastleQ 1');
$phpunit->assertTrue($board->_BCastleK, '_BCastleK 1');
$err = $board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w Qkq d6 5 12');
$phpunit->assertTrue($err, 'not valid parse');
$phpunit->assertTrue($board->_WCastleQ, '_WCastleQ 2');
$phpunit->assertFalse($board->_WCastleK, '_WCastleK 2');
$phpunit->assertTrue($board->_BCastleQ, '_BCastleQ 2');
$phpunit->assertTrue($board->_BCastleK, '_BCastleK 2');
$err = $board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w kq d6 5 12');
$phpunit->assertTrue($err, 'not valid parse');
$phpunit->assertFalse($board->_WCastleQ, '_WCastleQ 3');
$phpunit->assertFalse($board->_WCastleK, '_WCastleK 3');
$phpunit->assertTrue($board->_BCastleQ, '_BCastleQ 3');
$phpunit->assertTrue($board->_BCastleK, '_BCastleK 3');
$err = $board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w q d6 5 12');
$phpunit->assertTrue($err, 'not valid parse');
$phpunit->assertFalse($board->_WCastleQ, '_WCastleQ 4');
$phpunit->assertFalse($board->_WCastleK, '_WCastleK 4');
$phpunit->assertTrue($board->_BCastleQ, '_BCastleQ 4');
$phpunit->assertFalse($board->_BCastleK, '_BCastleK 4');
$err = $board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w - d6 5 12');
$phpunit->assertTrue($err, 'not valid parse');
$phpunit->assertFalse($board->_WCastleQ, '_WCastleQ 5');
$phpunit->assertFalse($board->_WCastleK, '_WCastleK 5');
$phpunit->assertFalse($board->_BCastleQ, '_BCastleQ 5');
$phpunit->assertFalse($board->_BCastleK, '_BCastleK 5');
echo 'tests done';
?>
--EXPECT--
tests done