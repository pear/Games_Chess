--TEST--
Games_Chess->_parseFen() invalid #8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_parseFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w QKqw 4 5 6');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Invalid FEN - "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w QKqw 4 5 6" the castling indicator "w" is invalid'),
), 1);
echo 'tests done';
?>
--EXPECT--
tests done