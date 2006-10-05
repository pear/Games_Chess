<?php
require_once 'Games/Chess.php';
require_once 'Games/Chess/Standard.php';
require_once dirname(dirname(__FILE__)) . '/phpt_test.php.inc';
$board = new Games_Chess_Standard();
$board->blankBoard();
$phpunit = new PEAR_PHPTest();
