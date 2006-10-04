--TEST--
Games_Chess->getPieceTypes()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'B', 'a1');
$board->addPiece('W', 'B', 'a2');
$board->addPiece('W', 'P', 'a3');
$err = $board->_getPieceTypes();
$phpunit->assertEquals(
    array(
        'W' => array(
                 'B' => array('B', 'W'),
                 'P' => array('B')
               ),
        'B' => array(),
    ),
    $err, 'wrong pieces');
echo 'tests done';
?>
--EXPECT--
tests done