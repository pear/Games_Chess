--TEST--
Games_Chess->_parseFen() invalid #13
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQk d1 0 1');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR b KQk d1 0 1" the en passant square indicator "d1" is invalid'),
), 1);
echo 'tests done';
?>
--EXPECT--
tests done