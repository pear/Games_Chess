--TEST--
Games_Chess->_parseFen() invalid #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_parseFen('hello');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Invalid FEN - "hello" has 1 fields, 6 is required'),
), 1);
echo 'tests done';
?>
--EXPECT--
tests done