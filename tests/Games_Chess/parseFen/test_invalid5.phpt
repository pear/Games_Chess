--TEST--
Games_Chess->_parseFen() invalid #5
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_parseFen('RKQBPRNN/RQ 2 3 4 5 6');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Invalid FEN - "RKQBPRNN/RQ 2 3 4 5 6" has too few pieces for a chessboard'),
), 1);
echo 'tests done';
?>
--EXPECT--
tests done