--TEST--
Games_Chess->getAllPieceLocations() invalid color
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->getPieceLocations('White');
$phpunit->assertErrors(array(
    'package' => 'PEAR_Error', 'message' => '"WHITE" is not a valid piece color, try W or B'
), 1);
echo 'tests done';
?>
--EXPECT--
tests done