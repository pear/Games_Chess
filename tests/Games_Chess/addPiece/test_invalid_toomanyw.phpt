--TEST--
Games_Chess->addPiece() invalid, too many pieces (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
for($i=0; $i<8; $i++) {
    $err = $board->addPiece('W', 'P', 'g' . ($i + 1));
    $phpunit->assertSame($err, true, $i);
}
$err = $board->addPiece('W', 'P', 'a4');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many White Pawns')
), 'W P a4');

$err = $board->addPiece('W', 'Q', 'a4');
$phpunit->assertSame($err, true, 'Qa4');
$err = $board->addPiece('W', 'Q', 'a5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many White Queens')
), 'W Q a5');

$err = $board->addPiece('W', 'R', 'a6');
$phpunit->assertSame($err, true, 'Ra6');
$err = $board->addPiece('W', 'R', 'a7');
$phpunit->assertSame($err, true, 'Ra7');
$err = $board->addPiece('W', 'R', 'a5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many White Rooks')
), 'W R a5');

$err = $board->addPiece('W', 'N', 'b6');
$phpunit->assertSame($err, true, 'Nb6');
$err = $board->addPiece('W', 'N', 'b7');
$phpunit->assertSame($err, true, 'Nb7');
$err = $board->addPiece('W', 'N', 'b5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many White Knights')
), 'W N b5');

$err = $board->addPiece('W', 'B', 'c6');
$phpunit->assertSame($err, true, 'Wc6');
$err = $board->addPiece('W', 'B', 'c7');
$phpunit->assertSame($err, true, 'Wc7');
$err = $board->addPiece('W', 'B', 'c5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many White Bishops')
), 'W B c5');

$err = $board->addPiece('W', 'K', 'd6');
$phpunit->assertSame($err, true, 'Kd6');
$err = $board->addPiece('W', 'K', 'c5');
$phpunit->assertErrors(array(
    array('package' => 'PEAR_Error', 'message' => 'Too many White Kings')
), 'W K c5');
echo 'tests done';
?>
--EXPECT--
tests done