--TEST--
Games_Chess->getAllPieceLocations() valid black
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPieceLocations('B');
$phpunit->assertEquals(
    array(
        'a7', 'b7', 'c7', 'd7', 'e7', 'f7', 'g7', 'h7',
        'a8', 'b8', 'c8', 'd8', 'e8', 'f8', 'g8', 'h8'
    ),
    $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done