--TEST--
Games_Chess->getAllPieceLocations() valid white
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPieceLocations('W');
$phpunit->assertEquals(
    array(
        'a1', 'b1', 'c1', 'd1', 'e1', 'f1', 'g1', 'h1',
        'a2', 'b2', 'c2', 'd2', 'e2', 'f2', 'g2', 'h2'
    ),
    $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done