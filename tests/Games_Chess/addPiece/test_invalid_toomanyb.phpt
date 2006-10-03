--TEST--
Games_Chess->addPiece() invalid, too many pieces (black)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
for($i=0; $i<8; $i++) {
    $err = $board->addPiece('B', 'P', 'g' . ($i + 1));
    $phpunit->assertSame($err, true, $i);
}
$err = $board->addPiece('B', 'P', 'a4');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Pawns')
), 'B P a4');

$err = $board->addPiece('B', 'Q', 'a4');
$phpunit->assertSame($err, true, 'Qa4');
$err = $board->addPiece('B', 'Q', 'a5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Queens')
), 'B Q a5');

$err = $board->addPiece('B', 'R', 'a6');
$phpunit->assertSame($err, true, 'Ra6');
$err = $board->addPiece('B', 'R', 'a7');
$phpunit->assertSame($err, true, 'Ra7');
$err = $board->addPiece('B', 'R', 'a5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Rooks')
), 'B R a5');

$err = $board->addPiece('B', 'N', 'b6');
$phpunit->assertSame($err, true, 'Nb6');
$err = $board->addPiece('B', 'N', 'b7');
$phpunit->assertSame($err, true, 'Nb7');
$err = $board->addPiece('B', 'N', 'b5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Knights')
), 'B N b5');

$err = $board->addPiece('B', 'B', 'c6');
$phpunit->assertSame($err, true, 'Bc6');
$err = $board->addPiece('B', 'B', 'c7');
$phpunit->assertSame($err, true, 'Bc7');
$err = $board->addPiece('B', 'B', 'c5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Bishops')
), 'B B c5');

$err = $board->addPiece('B', 'K', 'd6');
$phpunit->assertSame($err, true, 'Kd6');
$err = $board->addPiece('B', 'K', 'c5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many Black Kings')
), 'B K c5');
echo 'tests done';
?>
--EXPECT--
tests done