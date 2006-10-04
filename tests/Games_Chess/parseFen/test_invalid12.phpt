--TEST--
Games_Chess->_parseFen() invalid #12
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_parseFen('rnbqkppp/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 5 5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Invalid FEN - "rnbqkppp/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 5 5" Too many Black Pawns'),
), 1);
echo 'tests done';
?>
--EXPECT--
tests done