--TEST--
Games_Chess->inBasicDraw() not a basic draw #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'a4');
$board->addPiece('W', 'B', 'a1');
$board->addPiece('W', 'B', 'b1');
$board->addPiece('B', 'K', 'h8');
$board->addPiece('B', 'B', 'h1');
$phpunit->assertFalse($board->inBasicDraw(), 1);
echo 'tests done';
?>
--EXPECT--
tests done