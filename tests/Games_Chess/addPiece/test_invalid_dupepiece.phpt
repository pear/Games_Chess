--TEST--
Games_Chess->addPiece() invalid, duplicate piece on square
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->addPiece('W', 'P', 'a4');
$phpunit->assertSame($err, true, 'Pa4');
$err = $board->addPiece('B', 'P', 'a4');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Pawn already occupies square a4, cannot be replaced by Pawn')
), 'first try');

$err = $board->addPiece('W', 'N', 'a5');
$phpunit->assertSame($err, true, 'Pa4');
$err = $board->addPiece('B', 'B', 'a5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Knight already occupies square a5, cannot be replaced by Bishop')
), 'second try');
echo 'tests done';
?>
--EXPECT--
tests done