--TEST--
Games_Chess->inCheck() not in check
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertFalse($board->inCheck('W'),
    'should be empty, and is not');
$phpunit->assertFalse($board->inCheck('B'),
    'should be empty, and is not');
echo 'tests done';
?>
--EXPECT--
tests done