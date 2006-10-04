--TEST--
Games_Chess->inBasicDraw() only 2 kings on the board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'h2');
$board->addPiece('B', 'K', 'h7');
$phpunit->assertTrue($board->inBasicDraw(), 1);
echo 'tests done';
?>
--EXPECT--
tests done