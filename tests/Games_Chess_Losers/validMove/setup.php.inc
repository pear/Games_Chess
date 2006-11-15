<?php
require_once 'Games/Chess.php';
require_once 'Games/Chess/Losers.php';
require_once dirname(dirname(dirname(__FILE__))) . '/phpt_test.php.inc';
$board = new Games_Chess_Losers();
$board->blankBoard();
$phpunit = new PEAR_PHPTest();
