--TEST--
Games_Chess_Crazyhouse->addPiece() invalid, too many black pieces
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->addPiece('W', 'P', 'a4');
$phpunit->assertTrue($err, 'Pa4');
$err = $board->addPiece('B', 'P', 'a4');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Pawn already occupies square a4, cannot be replaced by Pawn')
), 'move 1');

$err = $board->addPiece('W', 'N', 'a5');
$phpunit->assertTrue($err, 'Na5');
$err = $board->addPiece('B', 'B', 'a5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Knight already occupies square a5, cannot be replaced by Bishop')
), 'move 2');
echo 'tests done';
?>
--EXPECT--
tests done