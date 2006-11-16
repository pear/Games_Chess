<?php
require_once 'Games/Chess.php';
require_once 'Games/Chess/Crazyhouse.php';
require_once dirname(dirname(dirname(__FILE__))) . '/phpt_test.php.inc';
$board = new Games_Chess_Crazyhouse();
$board->blankBoard();
$phpunit = new PEAR_PHPTest();
$board->blankBoard();