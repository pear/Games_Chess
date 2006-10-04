--TEST--
Games_Chess->_getSquareFromParsedMove() invalid ambiguous Qh4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'Q', 'h2');
$board->addPiece('W', 'Q', 'e4');
$a = $board->_parseMove('Qh4');
$err = $board->_getSquareFromParsedMove(current($a));
$phpunit->assertErrors(
    array('package' => 'PEAR_Error', 'message' => '"Qh4" does not resolve ambiguity between Queens on h2 e4')
, 1);
echo 'tests done';
?>
--EXPECT--
tests done