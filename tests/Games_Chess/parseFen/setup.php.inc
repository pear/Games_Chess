<?php
require_once 'Games/Chess.php';
require_once 'Games/Chess/Standard.php';
require_once dirname(dirname(dirname(__FILE__))) . '/phpt_test.php.inc';
$board = new Games_Chess_Standard();
$board->blankBoard();
$phpunit = new PEAR_PHPTest();
class Games_Chess_testStandard extends Games_Chess_Standard {
    var $pieces = array();
    function addPiece($color, $type, $square)
    {
        $this->pieces[] = array($color, $type, $square);
    }
}
