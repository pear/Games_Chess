<?php
require_once 'Games/Chess.php';
require_once 'Games/Chess/Standard.php';
require_once dirname(dirname(dirname(__FILE__))) . '/phpt_test.php.inc';
$board = new Games_Chess_Standard();
$phpunit = new PEAR_PHPTest();