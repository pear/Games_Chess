--TEST--
Games_Chess->_parseFen() invalid #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_parseFen('1$ 2 3 4 5 6');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Invalid FEN - "1$ 2 3 4 5 6" the character "$" is not a valid piece, separator or number'),
), 1);
echo 'tests done';
?>
--EXPECT--
tests done