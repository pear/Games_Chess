--TEST--
Games_Chess->getCastleSquares() white
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_move = 'B';
for ($i = ord('a'); $i <= ord('h'); $i++) {
    for ($j = 1; $j <= 8; $j++) {
        $ret = $board->_getCastleSquares(chr($i) . $j);
        if (chr($i) . $j == 'e8') {
            $phpunit->assertEquals(array('g8', 'c8'),
               $ret, 'Incorrect castle squares ' . chr($i) . $j);
        } else {
            $phpunit->assertEquals(array(),
                $ret, 'Incorrect castle squares ' . chr($i) . $j);
        }
    }
}
echo 'tests done';
?>
--EXPECT--
tests done