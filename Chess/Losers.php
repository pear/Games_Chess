<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The PHP Group                                     |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at                              |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Gregory Beaver <cellog@php.net>                             |
// +----------------------------------------------------------------------+
//
// $Id$
/**
 * A Losers chess game representation (wild 16 on ICC)
 * @package Games_Chess
 * @author Gregory Beaver <cellog@php.net>
 */
/**
 * The parent class
 */
require_once 'Games/Chess/Standard.php';

/**
 * Losers chess game
 *
 * The goal of the game is to lose all of your pieces or force your opponent
 * to checkmate you.  The only differences from standard chess are that if
 * a capture is possible it must be executed, similar to checkers, and
 * checkmate actually loses the game!
 * @package Games_Chess
 * @author Gregory Beaver <cellog@php.net>
 */
class Games_Chess_Losers extends Games_Chess_Standard {
    /**
     * Determine whether it is possible to capture an opponent's piece
     * @access protected
     */
    function _capturePossible()
    {
        $allmoves = array();
        $color = $this->_move == 'W' ? 'B' : 'W';
        foreach ($this->_pieces as $name => $loc) {
            if (!$loc) {
                continue;
            }
            if ($name{0} == $this->_move) {
                // don't return castle move shortcuts
                if ($name{1} == 'P') {
                    $allmoves = array_merge($allmoves,
                        $this->getPossibleMoves($loc[1], $loc[0], $this->_move, false));
                } else {
                    $allmoves = array_merge($allmoves,
                        $this->getPossibleMoves($name{1}, $loc, $this->_move, false));
                }
            }
        }
        foreach ($this->_pieces as $name => $loc) {
            if ($name{0} == $this->_move || !$loc) {
                continue;
            }
            if (is_array($loc)) {
                if (in_array($loc[0], $allmoves)) {
                    return true;
                }
            } else {
                if (in_array($loc, $allmoves)) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * Validate a move
     * @param array parsed move array from {@link _parseMove()}
     * @return true|PEAR_Error
     * @throws GAMES_CHESS_ERROR_MOVE_MUST_CAPTURE
     * @access protected
     */
    function _validMove($move)
    {
        list($type, $info) = each($move);
        if ($this->_capturePossible() &&
              ($type == GAMES_CHESS_CASTLE ||
              $this->_board[$info['square']] == $info['square'])) {
            if ($type == GAMES_CHESS_CASTLE) {
                $san = $info == 'K' ? 'O-O' : 'O-O-O';
            } else {
                $san = $info['piece'] . $info['disambiguate'] . $info['takes'] . $info['square'];
            }
            return $this->raiseError(GAMES_CHESS_ERROR_MOVE_MUST_CAPTURE,
                      array('san' => $san));
        }
        return parent::_validMove($move);
    }
    
    /**
     * @return W|B|D winner of game, or draw
     */
    function gameOver()
    {
        $opposite = $this->_move == 'W' ? 'B' : 'W';
        if ($this->inCheckmate()) {
            return $this->_move;
        }
        if ($this->inDraw()) {
            return 'D';
        }
        $W = array();
        $B = array();
        foreach ($this->_pieces as $name => $loc) {
            if (!$loc || $name{1} == 'K') {
                continue;
            }
            if ($name{0} == 'W') {
                $W[] = 1;
            } else {
                $B[] = 1;
            }
        }
        if (!count($W)) {
            return 'W';
        }
        if (!count($B)) {
            return 'B';
        }
        return false;
    }
}
?>