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
 * A standard chess game representation
 * @package Games_Chess
 * @author Gregory Beaver <cellog@php.net>
 */
/**
 * The parent class
 */
require_once 'Games/Chess/Standard.php';

/**
 * Crazyhouse chess game
 * 
 * A captured piece may be placed on the board as your own piece!
 * Note that FEN is incapable of setting up a game mid-swing - no
 * record of captured pieces is possible.  If requested, a future version
 * may extend the FEN standard to allow this, particularly if ICC follows
 * the same standard
 * @package Games_Chess
 * @author Gregory Beaver <cellog@php.net>
 */
class Games_Chess_Crazyhouse extends Games_Chess_Standard {
    /**
     * @var array
     */
    var $_captured =
        array(
            'W' =>
                array(
                    'P' => 0,
                    'B' => 0,
                    'N' => 0,
                    'Q' => 0,
                    'R' => 0,
                ),
            'B' =>
                array(
                    'P' => 0,
                    'B' => 0,
                    'N' => 0,
                    'Q' => 0,
                    'R' => 0,
                )
        );

    /**
     *
     */
    var $_pieces =
        array(
            'W' =>
                array(
                    'P' =>
                        array(),
                    'B' =>
                        array(),
                    'N' =>
                        array(),
                    'Q' =>
                        array(),
                    'R' =>
                        array(),
                    'K' =>
                        array(),
                ),
            'B' =>
                array(
                    'P' =>
                        array(),
                    'B' =>
                        array(),
                    'N' =>
                        array(),
                    'Q' =>
                        array(),
                    'R' =>
                        array(),
                    'K' =>
                        array(),
                ),
        );
    /**
     * Set up a blank chess board
     */
    function blankBoard()
    {
        Games_Chess::blankBoard();
    }

    /**
     * Set up a starting position for a new chess game
     * @access protected
     */
    function _setupStartingPosition()
    {
        parent::_setupStartingPosition();
        $this->_board = array(
'a8' => 'BR0', 'b8' => 'BN0', 'c8' => 'BB0', 'd8' => 'BQ0', 'e8' => 'BK0', 'f8' => 'BB1', 'g8' => 'BN1', 'h8' => 'BR1',
'a7' => 'BP0', 'b7' => 'BP1', 'c7' => 'BP2', 'd7' => 'BP3', 'e7' => 'BP4', 'f7' => 'BP5', 'g7' => 'BP6', 'h7' => 'BP7',
'a6' => 'a6', 'b6' => 'b6', 'c6' => 'c6', 'd6' => 'd6', 'e6' => 'e6', 'f6' => 'f6', 'g6' => 'g6', 'h6' => 'h6',
'a5' => 'a5', 'b5' => 'b5', 'c5' => 'c5', 'd5' => 'd5', 'e5' => 'e5', 'f5' => 'f5', 'g5' => 'g5', 'h5' => 'h5',
'a4' => 'a4', 'b4' => 'b4', 'c4' => 'c4', 'd4' => 'd4', 'e4' => 'e4', 'f4' => 'f4', 'g4' => 'g4', 'h4' => 'h4',
'a3' => 'a3', 'b3' => 'b3', 'c3' => 'c3', 'd3' => 'd3', 'e3' => 'e3', 'f3' => 'f3', 'g3' => 'g3', 'h3' => 'h3',
'a2' => 'WP0', 'b2' => 'WP1', 'c2' => 'WP2', 'd2' => 'WP3', 'e2' => 'WP4', 'f2' => 'WP5', 'g2' => 'WP6', 'h2' => 'WP7',
'a1' => 'WR0', 'b1' => 'WN0', 'c1' => 'WB0', 'd1' => 'WQ0', 'e1' => 'WK0', 'f1' => 'WB1', 'g1' => 'WN1', 'h1' => 'WR1',
        );
        $this->_pieces =
        array(
            'W' =>
                array(
                    'P' =>
                        array(
                            array('a2', 'P'),
                            array('b2', 'P'),
                            array('c2', 'P'),
                            array('d2', 'P'),
                            array('e2', 'P'),
                            array('f2', 'P'),
                            array('g2', 'P'),
                            array('h2', 'P'),
                        ),
                    'B' =>
                        array(
                            'c1',
                            'f1',
                        ),
                    'N' =>
                        array(
                            'b1',
                            'g1',
                        ),
                    'Q' =>
                        array(
                            'd1'
                        ),
                    'R' =>
                        array(
                            'a1',
                            'h1',
                        ),
                    'K' =>
                        array(
                            'e1'
                        ),
                ),
            'B' =>
                array(
                    'P' =>
                        array(
                            array('a7', 'P'),
                            array('b7', 'P'),
                            array('c7', 'P'),
                            array('d7', 'P'),
                            array('e7', 'P'),
                            array('f7', 'P'),
                            array('g7', 'P'),
                            array('h7', 'P'),
                        ),
                    'B' =>
                        array(
                            'c8',
                            'f8',
                        ),
                    'N' =>
                        array(
                            'b8',
                            'g8',
                        ),
                    'Q' =>
                        array(
                            'd8',
                        ),
                    'R' =>
                        array(
                            'a8',
                            'h8',
                        ),
                    'K' =>
                        array(
                            'e8'
                        ),
                ),
        );
    }

    /**
     * Make a move from a Standard Algebraic Notation (SAN) format
     *
     * SAN is just a normal chess move like Na4, instead of the English Notation,
     * like NR4
     * @param string
     * @return true|PEAR_Error
     */
    function moveSAN($move)
    {
        if (!is_array($this->_board)) {
            $this->resetGame();
        }
        if (!strpos($move, '@')) {
            return parent::moveSAN($move);
        }
        if (!$this->isError($parsedMove = $this->_parseMove($move))) {
            if (!$this->isError($err = $this->_validMove($parsedMove))) {
                $p = $parsedMove[GAMES_CHESS_PIECEPLACEMENT]['piece'];
                $sq = $parsedMove[GAMES_CHESS_PIECEPLACEMENT]['square'];
                $this->_captured[$this->_move][$p]--;
                $set = ($p == 'P') ? array($sq, 'P') : $sq;
                $this->_pieces[$this->_move][$p][] = $set;
                $this->_board[$sq] = $this->_move . $p .
                    (count($this->_pieces[$this->_move][$p]) - 1);
                $this->_enPassantSquare = '-';
                $this->_moves[$this->_moveNumber][($this->_move == 'W') ? 0 : 1] = $move;
                $oldMoveNumber = $this->_moveNumber;
                $this->_moveNumber += ($this->_move == 'W') ? 0 : 1;
                $this->_halfMoves++;
                $moveWithCheck = $move;
                if ($this->inCheckMate(($this->_move == 'W') ? 'B' : 'W')) {
                    $moveWithCheck .= '#';
                } elseif ($this->inCheck(($this->_move == 'W') ? 'B' : 'W')) {
                    $moveWithCheck .= '+';
                }
                $this->_movesWithCheck[$oldMoveNumber][($this->_move == 'W') ? 0 : 1] = $moveWithCheck;
                $this->_move = ($this->_move == 'W' ? 'B' : 'W');
                
                // increment the position counter for this position
                $x = $this->renderFen(false);
                if (!isset($this->_allFENs[$x])) {
                    $this->_allFENs[$x] = 0;
                }
                $this->_allFENs[$x]++;
                return true;
            } else {
                return $err;
            }
        } else {
            return $parsedMove;
        }
    }

    function _validMove($move)
    {
        list($type, $info) = each($move);
        reset($move);
        if ($type == GAMES_CHESS_PIECEPLACEMENT) {
            if (!$this->_captured[$this->_move][$info['piece']]) {
                return $this->raiseError(GAMES_CHESS_ERROR_NOPIECES_TOPLACE,
                    array('color' => $this->_move, 'piece' => $info['piece']));
            }
            if ($this->_board[$info['square']] != $info['square']) {
                return $this->raiseError(GAMES_CHESS_ERROR_PIECEINTHEWAY,
                    array('square' => $info['square']));
            }
            return true;
        } else {
            return parent::_validMove($move);
        }
    }

    function _takePiece($square)
    {
        $piece = $this->_board[$square];
        unset($this->_pieces[$piece{0}][$piece{1}][$piece{2} + 0]);
        // add a piece to the list of pieces captured by the enemy
        $this->_captured[$piece{0} == 'W' ? 'B' : 'W'][$piece{1}]++;
        // ensure integrity of the remaining pieces
        for ($i = $piece{2} + 1; $i <= count($this->_pieces[$piece{0}][$piece{1}]); $i++) {
            $value = $this->_pieces[$piece{0}][$piece{1}][$i];
            // get the square this piece is on
            if (is_array($value)) {
                $value = $value[0];
            }
            // adjust to the right value
            $this->_board[$value]{2} = ($this->_board[$value]{2} - 1) . '';
        }
        // fix the indices
        $this->_pieces[$piece{0}][$piece{1}] = array_values($this->_pieces[$piece{0}][$piece{1}]);
    }

    /**
     * Move a piece from one square to another, disregarding any existing pieces
     *
     * {@link _takePiece()} should always be used prior to this method.  No
     * validation is performed
     * @param string [a-h][1-8] square the piece resides on
     * @param string [a-h][1-8] square the piece moves to
     * @param string Piece to promote to if this is a promotion move
     */
    function _movePiece($from, $to, $promote = '')
    {
        $piece = $this->_board[$from];
        if ($piece == $from) {
            return;
        }
        if (isset($this->_pieces[$piece{0}][$piece{1}][$piece{2}])) {
            $newto = $this->_pieces[$piece{0}][$piece{1}][$piece{2}];
            if (is_array($newto)) {
                $newto[0] = $to;
                if ($to{1} == '8' || $to{1} == '1') {
                    $newto[1] = $promote;
                }
            } else {
                $newto = $to;
            }
            $this->_pieces[$piece{0}][$piece{1}][$piece{2}] = $newto;
        }
    }
    
    /**
     * Translate an algebraic coordinate into the color and name of a piece,
     * or false if no piece is on that square
     * @return false|array Format array('color' => B|W, 'piece' => P|R|Q|N|K|B)
     * @param string [a-h][1-8]
     * @access protected
     */
    function _squareToPiece($square)
    {
        if ($this->_board[$square] != $square) {
            $piece = $this->_board[$square];
            if ($piece{1} == 'P') {
                $color = $piece{0};
                $piece = $this->_pieces[$piece{0}][$piece{1}][$piece{2}][1];
            } else {
                $color = $piece{0};
                $piece = $piece{1};
            }
            return array('color' => $color, 'piece' => $piece);
        } else {
            return false;
        }
    }
    
    /**
     * Retrieve the locations of all pieces of the same type as $piece
     * @param K|B|N|R|W|P
     * @param W|B
     * @param string [a-h][1-8] optional square of piece to exclude from the listing
     * @access protected
     * @return array
     */
    function _getAllPieceSquares($piece, $color, $exclude = null)
    {
        $ret = array();
        if ($piece != 'P') {
            foreach ($this->_pieces[$color]['P'] as $loc) {
                if ($loc[1] != $piece || $loc[0] == $exclude) {
                    continue;
                }
                $ret[] = $loc[0];
            }
        }
        foreach ($this->_pieces[$color][$piece] as $loc) {
            if ($loc != $exclude) {
                $ret[] = $loc;
            }
        }
        return $ret;
    }
    
    /**
     * @return string|PEAR_Error
     * @param array contents returned from {@link parent::_parseMove()}
     *              in other words, not array(GAMES_CHESS_PIECEMOVE =>
     *              array('piece' => 'K', ...)), but array('piece' => 'K', ...)
     * @param W|B current side moving
     */
    function _getSquareFromParsedMove($parsedmove, $color = null)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        switch ($parsedmove['piece']) {
            case 'K' :
                if (in_array($parsedmove['square'],
                    $this->getPossibleKingMoves($this->_pieces[$color]['K'][0], $color))) {
                    return $this->_pieces[$color]['K'][0];
                }
            break;
            case 'Q' :
            case 'B' :
            case 'R' :
            case 'N' :
                if ($parsedmove['disambiguate']) {
                    if (strlen($parsedmove['disambiguate']) == 2) {
                        $square = $parsedmove['disambiguate'];
                    } elseif (is_numeric($parsedmove['disambiguate'])) {
                        $row = $parsedmove['disambiguate'];
                    } else {
                        $col = $parsedmove['disambiguate'];
                    }
                } else {
                    $others = array();
                    $others = $this->_getAllPieceSquares($parsedmove['piece'],
                                                         $color);
                    $disambiguate = '';
                    $ambiguous = array();
                    if (count($others)) {
                        foreach ($others as $square) {
                            if (in_array($parsedmove['square'],
                                    $this->getPossibleMoves($parsedmove['piece'],
                                                            $square,
                                                            $color))) {
                                // other pieces can move to this square - need to disambiguate
                                $ambiguous[] = $square;
                            }
                        }
                    }
                    if (count($ambiguous) > 1) {
                        $pieces = implode($ambiguous, ' ');
                        return $this->raiseError(
                            GAMES_CHESS_ERROR_TOO_AMBIGUOUS,
                            array('san' => $parsedmove['piece'] .
                                $parsedmove['disambiguate'] . $parsedmove['takes']
                                . $parsedmove['square'],
                                  'squares' => $pieces,
                                  'piece' => $parsedmove['piece']));
                    }
                    $square = $col = $row = null;
                }
                $potentials = array();
                foreach ($this->_pieces[$color]['P'] as $name => $value) {
                    if (isset($square)) {
                        if ($value[0] == $square &&
                              $value[1] == $parsedmove['piece']) {
                            return $square;
                        }
                    } elseif (isset($col)) {
                        if ($value[0]{0} == $col &&
                              $value[1] == $parsedmove['piece']) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value[0], $color))) {
                                $potentials[] = $value[0];
                            }
                        }
                    } elseif (isset($row)) {
                        if ($value[0]{1} == $row &&
                              $value[1] == $parsedmove['piece']) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value[0], $color))) {
                                $potentials[] = $value[0];
                            }
                        }
                    } else {
                        if ($value[1] == $parsedmove['piece']) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value[0], $color))) {
                                $potentials[] = $value[0];
                            }
                        }
                    }
                }
                foreach ($this->_pieces[$color][$parsedmove['piece']] as $name => $value) {
                    if (isset($square)) {
                        if ($value == $square) {
                            return $square;
                        }
                    } elseif (isset($col)) {
                        if ($value{0} == $col) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value, $color))) {
                                $potentials[] = $value;
                            }
                        }
                    } elseif (isset($row)) {
                        if ($value{1} == $row) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value, $color))) {
                                $potentials[] = $value;
                            }
                        }
                    } else {
                        if (in_array($parsedmove['square'],
                              $this->getPossibleMoves($parsedmove['piece'],
                                                        $value, $color))) {
                            $potentials[] = $value;
                        }
                    }
                }
                if (count($potentials) == 1) {
                    return $potentials[0];
                }
            break;
            case 'P' :
                if ($parsedmove['disambiguate']) {
                    $square = $parsedmove['disambiguate'] . $parsedmove['takesfrom'];
                } else {
                    $square = null;
                }
                if ($parsedmove['takesfrom']) {
                    $col = $parsedmove['takesfrom'];
                } else {
                    $col = null;
                }
                $potentials = array();
                foreach ($this->_pieces[$color]['P'] as $name => $value) {
                    if (isset($square)) {
                        if ($value[0] == $square && $value[1] == 'P') {
                            return $square;
                        }
                    } elseif (isset($col)) {
                        if ($value[0]{0} == $col && $value[1] == 'P') {
                            if (in_array($parsedmove['square'],
                                  $this->getPossiblePawnMoves($value[0], $color))) {
                                $potentials[] = $value[0];
                            }
                        }
                    } else {
                        if ($value[1] == 'P') {
                            if (in_array($parsedmove['square'],
                                  $this->getPossiblePawnMoves($value[0], $color))) {
                                $potentials[] = $value[0];
                            }
                        }
                    }
                }
                if (count($potentials) == 1) {
                    return $potentials[0];
                }
            break;
        }
        if ($parsedmove['piece'] == 'P') {
            $san = $parsedmove['takesfrom'] . $parsedmove['takes'] . $parsedmove['square'];
        } else {
            $san = $parsedmove['piece'] .
                           $parsedmove['disambiguate'] . $parsedmove['takes'] .
                           $parsedmove['square'];
        }
        return $this->raiseError(GAMES_CHESS_ERROR_NOPIECE_CANDOTHAT,
            array('san' => $san,
                  'color' => $color));
    }

    /**
     * Get the location of the king
     *
     * assumes valid color input
     * @return false|string
     * @access protected
     */
    function _getKing($color = null)
    {
        if (!is_null($color)) {
            return $this->_pieces[$color]['K'][0];
        } else {
            return $this->_pieces[$this->_move]['K'][0];
        }
    }

    /**
     * Get the location of a piece
     *
     * This does NOT take an algebraic square as the argument, but the contents
     * of _board[algebraic square]
     * @param string
     * @return string|array
     * @access protected
     */
    function _getPiece($piece)
    {
        return $piece{1} == 'P' ?
            $this->_pieces[$piece{0}][$piece{1}][$piece{2}][0] :
            $this->_pieces[$piece{0}][$piece{1}][$piece{2}];
    }

    /**
     * Determine whether a piece name is a knight
     *
     * This does NOT take an algebraic square as the argument, but the contents
     * of _board[algebraic square]
     * @param string
     * @return boolean
     * @access protected
     */
    function _isKnight($piece)
    {
        return $piece{1} == 'N' ||
            ($piece{1} == 'P' &&
                $this->_pieces[$piece{0}][$piece{1}][$piece{2}][1] == 'N');
    }

    /**
     * Determine whether a piece name is a queen
     *
     * This does NOT take an algebraic square as the argument, but the contents
     * of _board[algebraic square]
     * @param string
     * @return boolean
     * @access protected
     */
    function _isQueen($piece)
    {
        return $piece{1} == 'Q' ||
            ($piece{1} == 'P' &&
                $this->_pieces[$piece{0}][$piece{1}][$piece{2}][1] == 'Q');
    }

    /**
     * Determine whether a piece name is a bishop
     *
     * This does NOT take an algebraic square as the argument, but the contents
     * of _board[algebraic square]
     * @param string
     * @return boolean
     * @access protected
     */
    function _isBishop($piece)
    {
        return $piece{1} == 'B' ||
            ($piece{1} == 'P' &&
                $this->_pieces[$piece{0}][$piece{1}][$piece{2}][1] == 'B');
    }

    /**
     * Determine whether a piece name is a rook
     *
     * This does NOT take an algebraic square as the argument, but the contents
     * of _board[algebraic square]
     * @param string
     * @return boolean
     * @access protected
     */
    function _isRook($piece)
    {
        return $piece{1} == 'R' ||
            ($piece{1} == 'P' &&
                $this->_pieces[$piece{0}][$piece{1}][$piece{2}][1] == 'R');
    }

    /**
     * Determine whether a piece name is a pawn
     *
     * This does NOT take an algebraic square as the argument, but the contents
     * of _board[algebraic square]
     * @param string
     * @return boolean
     * @access protected
     */
    function _isPawn($piece)
    {
        return $piece{1} == 'P' &&
                $this->_pieces[$piece{0}][$piece{1}][$piece{2}][1] == 'P';
    }
    
    /**
     * Determine whether it is possible to capture the piece delivering check,
     * or to interpose a piece in between the checking piece and the king
     * @param array squares that will block a checkmate
     * @param W|B color of the side attempting to prevent checkmate
     * @return boolean true if it is possible to remove check
     */
    function _interposeOrCapture($squares, $color)
    {
        foreach ($this->_pieces[$color] as $name => $pieces) {
            if ($name == 'K') {
                continue;
            }
            foreach ($pieces as $value) {
                if (is_array($value)) {
                    $name = $value[1];
                    $value = $value[0];
                }
                $allmoves = $this->getPossibleMoves($name, $value, $color);
                foreach($squares as $square) {
                    if (in_array($square, $allmoves)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Get a list of all pieces on the board organized by the type of piece,
     * and the color of the square the piece is on.
     *
     * Used to determine basic draw conditions
     * @return array Format:
     *
     * <pre>
     * array(
     *   // white pieces
     *   'W' => array('B' => array('W', 'B'), // all bishops
     *                'K' => array('W'),...
     *               ),
     *   // black pieces
     *   'B' => array('Q' => array('B'), // all queens
     *                'K' => array('W'),... // king is on white square
     * </pre>
     * @access protected
     */
    function _getPieceTypes()
    {
        $ret = array('W' => array(), 'B' => array());
        foreach($this->_pieces as $color => $all) {
            foreach ($all as $name => $pieces) {
                foreach ($pieces as $loc) {
                    if (is_array($loc)) {
                        $name = $loc[1];
                        $loc = $loc[0];
                    }
                    $ret[$color][$name][] = $this->_getDiagonalColor($loc);
                }
            }
        }
        return $ret;
    }

    /**
     * Used to determine check
     *
     * Retrieve all of the moves of the pieces matching the color passed in.
     * @param W|B
     * @return array
     * @access protected
     */
    function _getPossibleChecks($color)
    {
        $ret = array();
        foreach ($this->_pieces[$color] as $name => $pieces) {
            foreach ($pieces as $i => $loc) {
                if ($name == 'P') {
                    $ret[$color . $name . $i] = $this->getPossibleMoves($loc[1], $loc[0], $color, false);
                } else {
                    $ret[$color . $name . $i] = $this->getPossibleMoves($name, $loc, $color, false);
                }
            }
        }
        return $ret;
    }

    /**
     * Get the location of every piece on the board of color $color
     * @access protected
     * @param W|B color of pieces to check
     */
    function _getAllPieceLocations($color)
    {
        $ret = array();
        foreach ($this->_pieces[$color] as $name => $pieces) {
            foreach ($pieces as $loc) {
                $where =  (is_array($loc) ? $loc[0] : $loc);
                $ret[] = $where;
            }
        }
        return $ret;
    }

    /**
     * Render the current board position into Farnsworth-Edwards Notation
     *
     * This method only renders the board contents, not the castling and other
     * information
     * @return string
     * @access protected
     */
    function _renderFen()
    {
        $fen = '';
        $ws = 0;
        $saverow = '8';
        foreach ($this->_board as $square => $piece) {
            if ($square{1} != $saverow) {
                // if we have just moved to the next rank,
                // output any whitespace, and a '/'
                if ($ws) {
                    $fen .= $ws;
                }
                $fen .= '/';
                $ws = 0;
                $saverow = $square{1};
            }
            if ($square == $piece) {
                // increment whitespace - no piece on this square
                $ws++;
            } else {
                // add any whitespace and reset
                if ($ws) {
                    $fen .= $ws;
                }
                $ws = 0;
                if (is_array($this->_pieces[$piece{0}][$piece{1}][$piece{2}])) {
                    // add pawns/promoted pawns
                    $p = ($piece{0} == 'W') ? $this->_pieces[$piece{0}][$piece{1}][$piece{2}][1] :
                        strtolower($this->_pieces[$piece{0}][$piece{1}][$piece{2}][1]);
                } else {
                    // add pieces
                    $p = ($piece{0} == 'W') ? $piece{1} : strtolower($piece{1});
                }
                $fen .= $p;
            }
        }
        // add any trailing whitespace
        if ($ws) {
            $fen .= $ws;
        }
        return $fen;
    }

    /**
     * Determine whether one side's king is in check by the other side's pieces
     * @param W|B color of pieces to determine enemy check
     * @return string|array|false square of checking piece(s) or false
     */
    function inCheck($color)
    {
        $ret = array();
        $king = $this->_getKing($color);
        $possible = $this->_getPossibleChecks($color == 'W' ? 'B' : 'W');
        foreach ($possible as $piece => $squares) {
            if (in_array($king, $squares)) {
                $loc = $this->_pieces[$piece{0}][$piece{1}][$piece{2}];
                $ret[] = is_array($loc) ? $loc[0] : $loc;
            }
        }
        if (!count($ret)) {
            return false;
        }
        if (count($ret) == 1) {
            return $ret[0];
        }
        return $ret;
    }

    function toArray()
    {
        $ret = array();
        foreach ($this->_board as $square => $piece) {
            if ($piece == $square) {
                $ret[$square] = false;
                continue;
            }
            $lower = $piece{0};
            if (is_array($this->_pieces[$piece{0}][$piece{1}][$piece{2}])) {
                $piece = $this->_pieces[$piece{0}][$piece{1}][$piece{2}][1];
            } else {
                $piece = $piece{1};
            }
            if ($lower == 'B') {
                $piece = strtolower($piece);
            }
            $ret[$square] = $piece;
        }
        uksort($ret, array($this, '_sortToArray'));
        return array('board' => $ret, 'captured' => $this->_captured);
    }

    /**
     * Add a piece to the chessboard
     * @param W|B piece color
     * @param K|Q|R|N|P|B Piece type
     * @param string [a-h][1-8] algebraic location of piece
     * @return true|PEAR_Error
     * @throws GAMES_CHESS_ERROR_INVALIDSQUARE
     * @throws GAMES_CHESS_ERROR_DUPESQUARE
     * @throws GAMES_CHESS_ERROR_MULTIPIECE
     */
    function addPiece($color, $type, $square)
    {
        if (!isset($this->_board[$square])) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALIDSQUARE,
                array('square' => $square));
        }
        if ($this->_board[$square] != $square) {
            $dpiece = $this->_board[$square];
            if ($dpiece{1} == 'P') {
                $dpiece = $this->_pieces[$dpiece{0}][$dpiece{1}][$dpiece{2}][1];
            } else {
                $dpiece = $dpiece{1};
            }
            return $this->raiseError(GAMES_CHESS_ERROR_DUPESQUARE,
                array('piece' => $type, 'dpiece' => $dpiece, 'square' => $square));
        }
        switch ($type) {
            case 'B' :
            case 'N' :
            case 'R' :
            case 'Q' :
                $this->_pieces[$color][$type][] = $square;
                $this->_board[$square] = $color . $type .
                    (count($this->_pieces[$color][$type]) - 1);
            break;
            case 'P' :
                // handle regular pawns
                $this->_pieces[$color]['P'][] =
                    array($square, 'P');
                $this->_board[$square] = $color . 'P' . (count($this->_pieces[$color]['P']) - 1);
            break;
            case 'K' :
                if (!isset($this->_pieces[$color]['K'][0])) {
                    $this->_pieces[$color]['K'][0] = $square;
                    $this->_board[$square] = $color . 'K0';
                } else {
                    return $this->raiseError(GAMES_CHESS_ERROR_MULTIPIECE,
                        array('color' => $color, 'piece' => $type));
                }
            break;
        }
        return true;
    }

    /**
     * Basic draw is impossible in crazyhouse, because it is always possible
     * to place another piece
     * @return false
     */
    function inBasicDraw()
    {
        return false;
    }

    /**
     * Repetition draw is not allowed in crazyhouse
     * @return false
     */
    function inRepetitionDraw()
    {
        return false;
    }

    /**
     * 50 move draw is not allowed in crazyhouse
     * @return false
     */
    function in50MoveDraw()
    {
        return false;
    }
}
?>