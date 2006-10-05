--TEST--
Games_Chess->_squareToPiece() empty square
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertFalse($board->_squareToPiece('a1'),1);
echo 'tests done';
?>
--EXPECT--
tests done