--TEST--
Games_Chess_Crazyhouse->addPiece() invalid, too many white pieces
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$err = $board->addPiece('W', 'K', 'd6');
$phpunit->assertTrue($err, 'Kd6');
$err = $board->addPiece('W', 'K', 'c5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many White Kings')
), 'move');
echo 'tests done';
?>
--EXPECT--
tests done