<?php

/**
 * HTML output for PHPUnit suite tests.
 *
 * Copied for Games_Chesss from HTML_CSS
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_CSS
 */

require_once 'TestUnit.php';
require_once 'HTML_TestListener.php';
require_once 'Games/Chess/Standard.php';
require_once 'Games/Chess/Losers.php';

$title = 'PhpUnit test run, Games_Chess package';
?>
<html>
<head>
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>
<body>
<h1><?php echo $title; ?></h1>
      <p>
	This page runs all the phpUnit self-tests, and produces nice HTML output.
      </p>
      <p>
	Unlike typical test run, <strong>expect many test cases to
	  fail</strong>.  Exactly those with <code>pass</code> in their name
	should succeed.
      </p>
      <p>
      For each test we display both the test result -- <span
      class="Pass">ok</span>, <span class="Failure">FAIL</span>, or
      <span class="Error">ERROR</span> -- and also a meta-result --
      <span class="Expected">as expected</span>, <span
      class="Unexpected">UNEXPECTED</span>, or <span
      class="Unknown">unknown</span> -- that indicates whether the
      expected test result occurred.  Although many test results will
      be 'FAIL' here, all meta-results should be 'as expected', except
      for a few 'unknown' meta-results (because of errors) when running
      in PHP3.
      </p>
      
<h2>Tests</h2>
	<?php
	$testcases = array(
    	    'Games_Chess_TestCase_getDiagonal',
    	    'Games_Chess_TestCase_getRookSquares',
    	    'Games_Chess_TestCase_getKnightSquares',
    	    'Games_Chess_TestCase_getKingSquares',
    	    'Games_Chess_TestCase_getCastleSquares',
    	    'Games_Chess_TestCase_parseMove',
    	    'Games_Chess_TestCase_addPiece',
    	    'Games_Chess_TestCase_parseFen',
    	    'Games_Chess_TestCase_getAllPieceLocations',
    	    'Games_Chess_TestCase_getPossibleKnightMoves',
    	    'Games_Chess_TestCase_getPossibleBishopMoves',
    	    'Games_Chess_TestCase_getPossibleRookMoves',
    	    'Games_Chess_TestCase_getPossibleQueenMoves',
    	    'Games_Chess_TestCase_getPossibleKingMoves',
    	    'Games_Chess_TestCase_getPossiblePawnMoves',
    	    'Games_Chess_TestCase_getPossibleMoves',
    	    'Games_Chess_TestCase_getPossibleChecks',
    	    'Games_Chess_TestCase_inCheck',
    	    'Games_Chess_TestCase_inCheckMate',
    	    'Games_Chess_TestCase_squareToPiece',
    	    'Games_Chess_TestCase_getAllPieceSquares',
    	    'Games_Chess_TestCase_convertSquareToSAN',
    	    'Games_Chess_TestCase_getSquareFromParsedMove',
    	    'Games_Chess_TestCase_movePiece',
            'Games_Chess_TestCase_moveAlgebraic',
            'Games_Chess_TestCase_moveSAN',
            'Games_Chess_TestCase_validMove',
            'Games_Chess_TestCase_getPathToKing',
            'Games_Chess_TestCase_interposeOrCapture',
            'Games_Chess_TestCase_inStaleMate',
            'Games_Chess_TestCase_getDiagonalColor',
            'Games_Chess_TestCase_getPieceTypes',
            'Games_Chess_TestCase_inBasicDraw',

            'Games_Chess_Losers_TestCase_capturePossible',
            'Games_Chess_Losers_TestCase_validMove',
            'Games_Chess_Losers_TestCase_gameOver',

            'Games_Chess_TestCase_bugEnPassant',
            'Games_Chess_TestCase_bugdxc3',
            'Games_Chess_TestCase_bugpromotion',
	);

	
	$suite = new PHPUnit_TestSuite();

	foreach ($testcases as $testcase) {
    	    include_once $testcase . '.php';
            $suite->addTestSuite($testcase);
	}

	$listener = new HTML_TestListener();
        $result = TestUnit::run($suite, $listener);
	$result->removeListener($listener);
	$result->report();

	?>
</body>
</html>
