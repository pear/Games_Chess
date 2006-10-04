--TEST--
Games_Chess->inBasicDraw() 2 kings/bishop
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'h2');
$board->addPiece('B', 'K', 'h7');
$board->addPiece('B', 'B', 'e4');
$phpunit->assertTrue($board->inBasicDraw(), 1);
echo 'tests done';
?>
--EXPECT--
tests done