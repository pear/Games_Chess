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
require_once 'Games/Chess.php';

/**
 * Standard chess game
 * @package Games_Chess
 * @author Gregory Beaver <cellog@php.net>
 */
class Games_Chess_Standard extends Games_Chess {
    /**
     * The chess pieces
     * @access private
     * @var array
     */
    var $_pieces;
    
    /**
     * Set up a blank chess board
     */
    function blankBoard()
    {
        parent::blankBoard();
        $this->_pieces =
        array(
            'WR1' => false,
            'WN1' => false,
            'WB1' => false,
            'WQ' => false,
            'WK' => false,
            'WB2' => false,
            'WN2' => false,
            'WR2' => false,
            
            'WP1' => false,
            'WP2' => false,
            'WP3' => false,
            'WP4' => false,
            'WP5' => false,
            'WP6' => false,
            'WP7' => false,
            'WP8' => false,
            
            'BP1' => false,
            'BP2' => false,
            'BP3' => false,
            'BP4' => false,
            'BP5' => false,
            'BP6' => false,
            'BP7' => false,
            'BP8' => false,
            
            'BR1' => false,
            'BN1' => false,
            'BB1' => false,
            'BQ' => false,
            'BK' => false,
            'BB2' => false,
            'BN2' => false,
            'BR2' => false,
        );
    }

    /**
     * Set up a starting position for a new chess game
     * @access protected
     */
    function _setupStartingPosition()
    {
        $this->_board = array(
'a8' => 'BR1', 'b8' => 'BN1', 'c8' => 'BB1', 'd8' => 'BQ', 'e8' => 'BK', 'f8' => 'BB2', 'g8' => 'BN2', 'h8' => 'BR2',
'a7' => 'BP1', 'b7' => 'BP2', 'c7' => 'BP3', 'd7' => 'BP4', 'e7' => 'BP5', 'f7' => 'BP6', 'g7' => 'BP7', 'h7' => 'BP8',
'a6' => 'a6', 'b6' => 'b6', 'c6' => 'c6', 'd6' => 'd6', 'e6' => 'e6', 'f6' => 'f6', 'g6' => 'g6', 'h6' => 'h6',
'a5' => 'a5', 'b5' => 'b5', 'c5' => 'c5', 'd5' => 'd5', 'e5' => 'e5', 'f5' => 'f5', 'g5' => 'g5', 'h5' => 'h5',
'a4' => 'a4', 'b4' => 'b4', 'c4' => 'c4', 'd4' => 'd4', 'e4' => 'e4', 'f4' => 'f4', 'g4' => 'g4', 'h4' => 'h4',
'a3' => 'a3', 'b3' => 'b3', 'c3' => 'c3', 'd3' => 'd3', 'e3' => 'e3', 'f3' => 'f3', 'g3' => 'g3', 'h3' => 'h3',
'a2' => 'WP1', 'b2' => 'WP2', 'c2' => 'WP3', 'd2' => 'WP4', 'e2' => 'WP5', 'f2' => 'WP6', 'g2' => 'WP7', 'h2' => 'WP8',
'a1' => 'WR1', 'b1' => 'WN1', 'c1' => 'WB1', 'd1' => 'WQ', 'e1' => 'WK', 'f1' => 'WB2', 'g1' => 'WN2', 'h1' => 'WR2',
        );
        $this->_halfMoves = 0;
        $this->_moveNumber = 1;
        $this->_move = 'W';
        $this->_WCastleQ = true;
        $this->_WCastleK = true;
        $this->_BCastleQ = true;
        $this->_BCastleK = true;
        $this->_enPassantSquare = '-';
        $this->_pieces =
        array(
            'WR1' => 'a1',
            'WN1' => 'b1',
            'WB1' => 'c1',
            'WQ' => 'd1',
            'WK' => 'e1',
            'WB2' => 'f1',
            'WN2' => 'g1',
            'WR2' => 'h1',
            
            'WP1' => array('a2', 'P'),
            'WP2' => array('b2', 'P'),
            'WP3' => array('c2', 'P'),
            'WP4' => array('d2', 'P'),
            'WP5' => array('e2', 'P'),
            'WP6' => array('f2', 'P'),
            'WP7' => array('g2', 'P'),
            'WP8' => array('h2', 'P'),
            
            'BP1' => array('a7', 'P'),
            'BP2' => array('b7', 'P'),
            'BP3' => array('c7', 'P'),
            'BP4' => array('d7', 'P'),
            'BP5' => array('e7', 'P'),
            'BP6' => array('f7', 'P'),
            'BP7' => array('g7', 'P'),
            'BP8' => array('h7', 'P'),
            
            'BR1' => 'a8',
            'BN1' => 'b8',
            'BB1' => 'c8',
            'BQ' => 'd8',
            'BK' => 'e8',
            'BB2' => 'f8',
            'BN2' => 'g8',
            'BR2' => 'h8',
        );
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
                $dpiece = $this->_pieces[$dpiece][1];
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
                $piece_name = $color . $type;
                if (!$this->_pieces[$piece_name . '1']) {
                    $this->_board[$square] = $piece_name . '1';
                    $this->_pieces[$piece_name . '1'] = $square;
                } elseif (!$this->_pieces[$piece_name . '2']) {
                    $this->_board[$square] = $piece_name . '2';
                    $this->_pieces[$piece_name . '2'] = $square;
                } else {
                    // handle promoted pawns
                    for ($col = 1; $col <= 8; $col++) {
                        if (!$this->_pieces[$color . 'P' . $col]) {
                            $this->_pieces[$color . 'P' . $col] =
                                array($square, $type);
                            $this->_board[$square] = $color . 'P' . $col;
                            break 2;
                        }
                    }
                    return $this->raiseError(GAMES_CHESS_ERROR_MULTIPIECE,
                        array('color' => $color, 'piece' => $type));

                }
            break;
            case 'Q' :
                $piece_name = $color . 'Q';
                if (!$this->_pieces[$piece_name]) {
                    $this->_board[$square] = $piece_name;
                    $this->_pieces[$piece_name] = $square;
                } else {
                    // handle promoted pawns
                    for ($col = 1; $col <= 8; $col++) {
                        if (!$this->_pieces[$color . 'P' . $col]) {
                            $this->_pieces[$color . 'P' . $col] =
                                array($square, 'Q');
                            $this->_board[$square] = $color . 'P' . $col;
                            break 2;
                        }
                    }
                    return $this->raiseError(GAMES_CHESS_ERROR_MULTIPIECE,
                        array('color' => $color, 'piece' => $type));
                }
            break;
            case 'P' :
                // handle regular pawns
                for ($col = 1; $col <= 8; $col++) {
                    if (!$this->_pieces[$color . 'P' . $col]) {
                        $this->_pieces[$color . 'P' . $col] =
                            array($square, 'P');
                        $this->_board[$square] = $color . 'P' . $col;
                        break 2;
                    }
                }
                return $this->raiseError(GAMES_CHESS_ERROR_MULTIPIECE,
                    array('color' => $color, 'piece' => $type));
            break;
            case 'K' :
                if (!$this->_pieces[$color . 'K']) {
                    $this->_pieces[$color . 'K'] = $square;
                    $this->_board[$square] = $color . 'K';
                } else {
                    return $this->raiseError(GAMES_CHESS_ERROR_MULTIPIECE,
                        array('color' => $color, 'piece' => $type));
                }
            break;
        }
        return true;
    }
    
    /**
     * Generate a representation of the chess board and pieces for use as a
     * direct translation to a visual chess board
     * @return array
     */
    function toArray()
    {
        $ret = array();
        foreach ($this->_board as $square => $piece) {
            if ($piece == $square) {
                $ret[$square] = false;
                continue;
            }
            $lower = $piece{0};
            if (is_array($this->_pieces[$piece])) {
                $piece = $this->_pieces[$piece][1];
            } else {
                $piece = $piece{1};
            }
            if ($lower == 'B') {
                $piece = strtolower($piece);
            }
            $ret[$square] = $piece;
        }
        uksort($ret, array($this, '_sortToArray'));
        return $ret;
    }
    
    /**
     * Sort two algebraic coordinates for easy display by foreach() iteration
     * @param string
     * @param string
     * @access private
     */
    function _sortToArray($a, $b)
    {
        if ($a == $b) {
            return 0;
        }
        if ($a{1} == $b{1}) {
            return strnatcmp($a{0}, $b{0});
        }
        if ($a{0} == $b{0}) {
            return strnatcmp($b{1}, $a{1});
        }
        if ($b{1} > $a{1}) {
            return 1;
        }
        if ($a{1} > $b{1}) {
            return -1;
        }
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
                if (is_array($this->_pieces[$piece])) {
                    // add pawns/promoted pawns
                    $p = ($piece{0} == 'W') ? $this->_pieces[$piece][1] :
                        strtolower($this->_pieces[$piece][1]);
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
     * Get the location of every piece on the board of color $color
     * @access protected
     * @param W|B color of pieces to check
     */
    function _getAllPieceLocations($color)
    {
        $ret = array();
        foreach ($this->_pieces as $name => $loc) {
            if ($name{0} == $color) {
                $where =  (is_array($loc) ? $loc[0] : $loc);
                if ($where) {
                    $ret[] = $where;
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
        foreach ($this->_pieces as $name => $loc) {
            if (!$loc) {
                continue;
            }
            if ($name{0} == $color) {
                if ($name{1} == 'P') {
                    $ret[$name] = $this->getPossibleMoves($loc[1], $loc[0], $color, false);
                } else {
                    $ret[$name] = $this->getPossibleMoves($name{1}, $loc, $color, false);
                }
            }
        }
        return $ret;
    }
    
    /**
     * Determine whether one side's king is in check by the other side's pieces
     * @param W|B color of pieces to determine enemy check
     * @return string|array|false square of checking piece(s) or false
     */
    function inCheck($color)
    {
        $ret = array();
        $king = $this->_pieces[$color . 'K'];
        $possible = $this->_getPossibleChecks($color == 'W' ? 'B' : 'W');
        foreach ($possible as $piece => $squares) {
            if (in_array($king, $squares)) {
                $loc = $this->_pieces[$piece];
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
    
    /**
     * Mark a piece as having been taken.  No validation is performed
     * @param string [a-h][1-8]
     * @access protected
     */
    function _takePiece($piece)
    {
        if (isset($this->_pieces[$this->_board[$piece]])) {
            $this->_pieces[$this->_board[$piece]] = false;
        }
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
        if (isset($this->_pieces[$this->_board[$from]])) {
            $newto = $this->_pieces[$this->_board[$from]];
            if (is_array($newto)) {
                $newto[0] = $to;
                if ($to{1} == '8' || $to{1} == '1') {
                    $newto[1] = $promote;
                }
            } else {
                $newto = $to;
            }
            $this->_pieces[$this->_board[$from]] = $newto;
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
                $piece = $this->_pieces[$piece][1];
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
        foreach ($this->_pieces as $name => $loc) {
            if (!$loc) {
                continue;
            }
            if ($name{0} != $color) {
                continue;
            }
            if ($name{1} == 'P') {
                if ($loc[1] != $piece || $loc[0] == $exclude) {
                    continue;
                } else {
                    $ret[] = $loc[0];
                    continue;
                }
            }
            if ($loc == $exclude) {
                continue;
            }
            if ($name{1} != $piece) {
                continue;
            }
            $ret[] = $loc;
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
                    $this->getPossibleKingMoves($this->_pieces[$color . 'K'], $color))) {
                    return $this->_pieces[$color . 'K'];
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
                foreach ($this->_pieces as $name => $value) {
                    if (!$value) {
                        continue;
                    }
                    if ($name{0} != $color) {
                        continue;
                    }
                    if (isset($square)) {
                        if ($name{1} == $parsedmove['piece'] &&
                              $value[0] == $square) {
                            return $square;
                        }
                        if ($name{1} == 'P' && $value[0] == $square &&
                              $value[1] == $parsedmove['piece']) {
                            return $square;
                        }
                    } elseif (isset($col)) {
                        if ($name{1} == $parsedmove['piece'] &&
                              $value{0} == $col) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value, $color))) {
                                $potentials[] = $value;
                            }
                        }
                        if ($name{1} == 'P' && $value[0]{0} == $col &&
                              $value[1] == $parsedmove['piece']) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value[0], $color))) {
                                $potentials[] = $value[0];
                            }
                        }
                    } elseif (isset($row)) {
                        if ($name{1} == $parsedmove['piece'] &&
                              $value{1} == $row) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value, $color))) {
                                $potentials[] = $value;
                            }
                        }
                        if ($name{1} == 'P' && $value[0]{1} == $row &&
                              $value[1] == $parsedmove['piece']) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value[0], $color))) {
                                $potentials[] = $value[0];
                            }
                        }
                    } else {
                        if ($name{1} == $parsedmove['piece']) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value, $color))) {
                                $potentials[] = $value;
                            }
                        } elseif ($name{1} == 'P' &&
                              $value[1] == $parsedmove['piece']) {
                            if (in_array($parsedmove['square'],
                                  $this->getPossibleMoves($parsedmove['piece'],
                                                            $value[0], $color))) {
                                $potentials[] = $value[0];
                            }
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
                foreach ($this->_pieces as $name => $value) {
                    if ($name{0} != $color) {
                        continue;
                    }
                    if (isset($square)) {
                        if ($name{1} == 'P' && $value[0] == $square && $value[1] == 'P') {
                            return $square;
                        }
                    } elseif (isset($col)) {
                        if ($name{1} == 'P' && $value[0]{0} == $col && $value[1] == 'P') {
                            if (in_array($parsedmove['square'],
                                  $this->getPossiblePawnMoves($value[0], $color))) {
                                $potentials[] = $value[0];
                            }
                        }
                    } else {
                        if ($name{1} == 'P' && $value[1] == 'P') {
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
            return $this->_pieces[$color . 'K'];
        } else {
            return $this->_pieces[$this->_move . 'K'];
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
    function _getPiece($piecename)
    {
        return is_array($this->_pieces[$piecename]) ?
            $this->_pieces[$piecename][0] :
            $this->_pieces[$piecename];
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
    function _isKnight($piecename)
    {
        return $piecename{1} == 'N' ||
            ($piecename{1} == 'P' &&
                $this->_pieces[$piecename][1] == 'N');
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
    function _isQueen($piecename)
    {
        return $piecename{1} == 'Q' ||
            ($piecename{1} == 'P' &&
                $this->_pieces[$piecename][1] == 'Q');
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
    function isBishop($piecename)
    {
        return $piecename{1} == 'B' ||
            ($piecename{1} == 'P' &&
                $this->_pieces[$piecename][1] == 'B');
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
    function isRook($piecename)
    {
        return $piecename{1} == 'R' ||
            ($piecename{1} == 'P' &&
                $this->_pieces[$piecename][1] == 'R');
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
    function isPawn($piecename)
    {
        return $piecename{1} == 'P' &&
                $this->_pieces[$piecename][1] == 'P';
    }
    
    /**
     * Determine whether a piece name is a king
     *
     * This does NOT take an algebraic square as the argument, but the contents
     * of _board[algebraic square]
     * @param string
     * @return boolean
     * @access protected
     */
    function isKing($piecename)
    {
        return $piecename{1} == 'K';
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
        foreach ($this->_pieces as $name => $value) {
            if (!$value) {
                continue;
            }
            if ($name{0} != $color) {
                continue;
            }
            if ($name{1} == 'K') {
                continue;
            }
            if (is_array($value)) {
                $name = $value[1];
                $value = $value[0];
            } else {
                $name = $name{1};
            }
            $allmoves = $this->getPossibleMoves($name, $value, $color);
            foreach($squares as $square) {
                if (in_array($square, $allmoves)) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * Retrieve the color of a piece from its name
     *
     * Game-specific method of retrieving the color of a piece
     * @access protected
     */
    function _getColor($name)
    {
        return $name{0};
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
        foreach($this->_pieces as $name => $loc) {
            if (!$loc) {
                continue;
            }
            $type = $name{1};
            if (is_array($loc)) {
                $type = $loc[1];
                $loc = $loc[0];
            }
            $ret[$name{0}][$type][] = $this->_getDiagonalColor($loc);
        }
        return $ret;
    }
}
?>