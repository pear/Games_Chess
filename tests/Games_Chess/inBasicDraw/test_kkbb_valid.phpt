--TEST--
Games_Chess->inBasicDraw() 2 kings/2 bishops, valid draw
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'a4');
$board->addPiece('W', 'B', 'a1');
$board->addPiece('B', 'K', 'h1');
$board->addPiece('B', 'B', 'h2');
$phpunit->assertTrue($board->inBasicDraw(), 1);
echo 'tests done';
?>
--EXPECT--
tests done