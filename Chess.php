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
 * The Games_Chess Package
 *
 * The logic of handling a chessboard and parsing standard
 * FEN (Farnsworth-Edwards Notation) for describing a position as well as SAN
 * (Standard Algebraic Notation) for describing individual moves is handled.  This
 * class can be used as a backend driver for playing chess, or for validating
 * and/or creating PGN files using the File_ChessPGN package.
rn *
 * Although this package is alpha, it is fully unit-tested.  The code works, but
 * the API is fluid, and may change dramatically as it is put into use and better
 * ways are found to use it.  When the API stabilizes, the stability will increase.
 *
 * To learn how to play chess, there are many sites online, try searching for
 * "chess."  To play online, I use the Internet Chess Club at
 * {@link http://www.chessclub.com} as CelloJi, look me up sometime :).  Don't
 * worry, I'm not very good.
 * @todo implement special class Games_Chess_Chess960 for Fischer Random Chess
 * @todo implement special class Games_Chess_Wild23 for ICC Wild variant 23
 * @author Gregory Beaver <cellog@php.net>
 * @copyright 2003
 * @license http://www.php.net/license/3_0.txt PHP License 3.0
 * @version @VER@
 */
/**#@+
 * Move constants
 */
/**
 * Castling move (O-O or O-O-O)
 */
define('GAMES_CHESS_CASTLE', 1);
/**
 * Pawn move (e4, e8=Q, exd5)
 */
define('GAMES_CHESS_PAWNMOVE', 2);
/**
 * Piece move (Qa4, Nfe6, Bxe5, Re2xe6)
 */
define('GAMES_CHESS_PIECEMOVE', 3);
/**
 * Special move type used in Wild23 like P@a4 (place a pawn at a4)
 */
define('GAMES_CHESS_PIECEPLACEMENT', 4);
/**#@-*/

/**#@+
 * Error Constants
 */
/**
 * Invalid Standard Algebraic Notation was used
 */
define('GAMES_CHESS_ERROR_INVALID_SAN', 1);
/**
 * The number of space-separated fields in a FEN passed to {@internal 
 * {@link _parseFen()} through }} {@link resetGame()} was incorrect, should be 6
 */
define('GAMES_CHESS_ERROR_FEN_COUNT', 2);
/**
 * A FEN containing multiple spaces in a row was parsed {@internal by
 * {@link _parseFen()}}}
 */
define('GAMES_CHESS_ERROR_EMPTY_FEN', 3);
/**
 * Too many pieces were passed in for the chessboard to fit them in a FEN
 * {@internal passed to {@link _parseFen()}}}
 */
define('GAMES_CHESS_ERROR_FEN_TOOMUCH', 4);
/**
 * The indicator of which side to move in a FEN was neither "w" nor "b"
 */
define('GAMES_CHESS_ERROR_FEN_TOMOVEWRONG', 5);
/**
 * The list of castling indicators was too long (longest is KQkq) of a FEN
 */
define('GAMES_CHESS_ERROR_FEN_CASTLETOOLONG', 6);
/**
 * Something other than K, Q, k or q was in the castling indicators of a FEN
 */
define('GAMES_CHESS_ERROR_FEN_CASTLEWRONG', 7);
/**
 * The en passant square was neither "-" nor an algebraic square in a FEN
 */
define('GAMES_CHESS_ERROR_FEN_INVALID_EP', 8);
/**
 * The ply count (number of half-moves) was not a number in a FEN
 */
define('GAMES_CHESS_ERROR_FEN_INVALID_PLY', 9);
/**
 * The move count (pairs of white/black moves) was not a number in a FEN
 */
define('GAMES_CHESS_ERROR_FEN_INVALID_MOVENUMBER', 10);
/**
 * An illegal move was attempted, the king is in check
 */
define('GAMES_CHESS_ERROR_IN_CHECK', 11);
/**
 * Can't castle kingside, either king or rook has moved
 */
define('GAMES_CHESS_ERROR_CANT_CK', 12);
/**
 * Can't castle kingside, pieces are in the way on the f and/or g files
 */
define('GAMES_CHESS_ERROR_CK_PIECES_IN_WAY', 13);
/**
 * Can't castle kingside, either king or rook has moved
 */
define('GAMES_CHESS_ERROR_CANT_CQ', 14);
/**
 * Can't castle queenside, pieces are in the way on the d, c and/or b files
 */
define('GAMES_CHESS_ERROR_CQ_PIECES_IN_WAY', 15);
/**
 * Castling would place the king in check, which is illegal
 */
define('GAMES_CHESS_ERROR_CASTLE_WOULD_CHECK', 16);
/**
 * Performing a requested move would place the king in check
 */
define('GAMES_CHESS_ERROR_MOVE_WOULD_CHECK', 17);
/**
 * The requested move does not remove a check on the king
 */
define('GAMES_CHESS_ERROR_STILL_IN_CHECK', 18);
/**
 * An attempt (however misguided) was made to capture one's own piece, illegal
 */
define('GAMES_CHESS_ERROR_CANT_CAPTURE_OWN', 19);
/**
 * An attempt was made to capture a piece on a square that does not contain a piece
 */
define('GAMES_CHESS_ERROR_NO_PIECE', 20);
/**
 * A attempt to move an opponent's piece was made, illegal
 */
define('GAMES_CHESS_ERROR_WRONG_COLOR', 21);
/**
 * A request was made to move a piece from one square to another, but it can't
 * move to that square legally
 */
define('GAMES_CHESS_ERROR_CANT_MOVE_THAT_WAY', 22);
/**
 * An attempt was made to add a piece to the chessboard, but there are too many
 * pieces of that type already on the chessboard
 */
define('GAMES_CHESS_ERROR_MULTIPIECE', 23);
/**
 * An attempt was made to add a piece to the chessboard through the parsing of
 * a FEN, but there are too many pieces of that type already on the chessboard
 */
define('GAMES_CHESS_ERROR_FEN_MULTIPIECE', 24);
/**
 * An attempt was made to add a piece to the chessboard on top of an existing piece
 */
define('GAMES_CHESS_ERROR_DUPESQUARE', 25);
/**
 * An invalid piece indicator was used in a FEN
 */
define('GAMES_CHESS_ERROR_FEN_INVALIDPIECE', 26);
/**
 * Not enough piece data was passed into the FEN to explain every square on the board
 */
define('GAMES_CHESS_ERROR_FEN_TOOLITTLE', 27);
/**
 * Something other than "W" or "B" was passed to a method needing a color
 */
define('GAMES_CHESS_ERROR_INVALID_COLOR', 28);
/**
 * Something that isn't SAN ([a-h][1-8]) was passed to a function requiring a
 * square location
 */
define('GAMES_CHESS_ERROR_INVALID_SQUARE', 29);
/**
 * Something other than "P", "Q", "R", "B", "N" or "K" was passed to a method
 * needing a piece type
 */
define('GAMES_CHESS_ERROR_INVALID_PIECE', 30);
/**
 * Something other than "Q", "R", "B", or "N" was passed to a method
 * needing a piece type for pawn promotion
 */
define('GAMES_CHESS_ERROR_INVALID_PROMOTE', 31);
/**
 * SAN was passed in that is too ambiguous - multiple pieces could execute
 * the move, and no disambiguation (like Naf3 or Bf3xe4) was used
 */
define('GAMES_CHESS_ERROR_TOO_AMBIGUOUS', 32);
/**
 * No piece of the current color can execute the SAN (as in, if Na3 is passed
 * in, but there are no knights that can reach a3
 */
define('GAMES_CHESS_ERROR_NOPIECE_CANDOTHAT', 33);
/**
 * In loser's chess, and the current move does not capture a piece although
 * capture is possible.
 */
define('GAMES_CHESS_ERROR_MOVE_MUST_CAPTURE', 34);
/**
 * When piece placement is attempted, but no pieces exist to be placed
 */
define('GAMES_CHESS_ERROR_NOPIECES_TOPLACE', 35);
/**
 * When piece placement is attempted, but there is a piece on the desired square already
 */
define('GAMES_CHESS_ERROR_PIECEINTHEWAY', 36);
/**
 * When a pawn placement on the first or back rank is attempted
 */
define('GAMES_CHESS_ERROR_CANT_PLACE_18', 37);
/**
 * ABSTRACT parent class - use {@link Games_Chess_Standard} for a typical
 * chess game
 *
 * This class contains a few public methods that are the only thing most
 * users of the package will ever need.  Protected methods are available
 * for usage by child classes, and it is expected that all child classes
 * will implement certain protected methods used by the utility methods in
 * this class.
 *
 * Public API methods used are:
 *
 * Game-related methods
 *
 * - {@link resetGame()}: in order to start a new game (pass a FEN for a starting
 *   position)
 * - {@link blankBoard()}: in order to start with an empty chessboard
 * - {@link addPiece()}: Use to add pieces one at a time to the board
 * - {@link moveSAN()}: Use to move pieces based on their SAN (Qa3, exd5, etc.)
 * - {@link moveSquare()}: Use to move pieces based on their square (a2 -> a3
 *   for Qa3, e4 -> d5 for exd5, etc.)
 *
 * Game state methods:
 *
 * - {@link inCheck()}: Use to determine the presence of check
 * - {@link inCheckMate()}: Use to determine a won game
 * - {@link inStaleMate()}: Use to determine presence of stalemate draw
 * - {@link in50MoveDraw()}: Use to determine presence of 50-move rule draw
 * - {@link inRepetitionDraw()}: Use to determine presence of a draw by repetition
 * - {@link inStaleMate()}: Use to determine presence of stalemate draw
 * - {@link inDraw()}: Use to determine if any forced draw condition exists
 *
 * Game data methods:
 *
 * - {@link renderFen()}: Use to retrieve a FEN representation of the
 *   current chessboard position, in order to transfer to another chess program
 * - {@link toArray()}: Use to retrieve a literal representation of the
 *   current chessboard position, in order to display as HTML or some other
 *   format for the user
 * - {@link getMoveList()}: Use to retrieve the list of SAN moves for this game
 * @package Games_Chess
 */
class Games_Chess {
    /**
     * Used for transactions
     * @var array
     * @access private
     */
    var $_saveState = array();
    /**
     * @var array
     * @access private
     */
    var $_board;
    /**
     * @var string
     * @access private
     */
    var $_move = 'W';
    /**
     * @var integer
     * @access private
     */
    var $_moveNumber = 1;
    /**
     * Half-moves since last pawn move or capture
     * @var integer
     * @access private
     */
    var $_halfMoves = 1;
    /**
     * Square that an en passant can happen, or "-"
     * @var string
     * @access private
     */
    var $_enPassantSquare = '-';
    /**
     * Moves in SAN format for easy write-out to a PGN file
     *
     * The format is:
     * <pre>
     * array(
     *  movenumber => array(White move, Black move),
     *  movenumber => array(White move, Black move),
     * )
     * </pre>
     * @var array
     * @access private
     */
    var $_moves = array();
    /**
     * Moves in SAN format for easy write-out to a PGN file, with check/checkmate annotations appended
     *
     * The format is:
     * <pre>
     * array(
     *  movenumber => array(White move, Black move),
     *  movenumber => array(White move, Black move),
     * )
     * </pre>
     * @var array
     * @access private
     */
    var $_movesWithCheck = array();
    /**
     * Store every position from the game, used to determine draw by repetition
     *
     * If the exact same position is encountered three times, then it is a draw
     * @var array
     * @access private
     */
    var $_allFENs = array();
    /**#@+
     * Castling rights
     * @var boolean
     * @access private
     */
    var $_WCastleQ = true;
    var $_WCastleK = false;
    var $_BCastleQ = true;
    var $_BCastleK = false;
    /**#@-*/
    /**
     * Contents of the last move returned from {@link _parseMove()}, used to
     * process en passant.
     * @var false|array
     * @access private
     */
    var $_lastMove = false;
    
    /**
     * Create a blank chessboard with no pieces on it
     */
    function blankBoard()
    {
        $this->_board = array();
        for ($j = 8; $j >= 1; $j--) {
            for ($i = ord('a'); $i <= ord('h'); $i++) {
                $this->_board[chr($i) . $j] = chr($i) . $j;
            }
        }
    }

    /**
     * Create a new game with the starting position, or from the position
     * specified by $fen
     *
     * @param false|string
     * @return PEAR_Error|true returns any errors thrown by {@link _parseFen()}
     */
    function resetGame($fen = false)
    {
        $this->_saveState = array();
        if (!$fen) {
            $this->_setupStartingPosition();
        } else {
            return $this->_parseFen($fen);
        }
        return true;
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
        if (!$this->isError($parsedMove = $this->_parseMove($move))) {
            if (!$this->isError($err = $this->_validMove($parsedMove))) {
                list($key, $parsedMove) = each($parsedMove);
                $this->_moves[$this->_moveNumber][($this->_move == 'W') ? 0 : 1] = $move;
                $oldMoveNumber = $this->_moveNumber;
                $this->_moveNumber += ($this->_move == 'W') ? 0 : 1;
                $this->_halfMoves++;
                if ($key == GAMES_CHESS_CASTLE) {
                    $a = ($parsedMove == 'Q') ? 'K' : 'Q';
                    // clear castling rights
                    $this->{'_' . $this->_move . 'Castle' . $parsedMove} = false;
                    $this->{'_' . $this->_move . 'Castle' . $a} = false;
                    $row = ($this->_move == 'W') ? 1 : 8;
                    switch ($parsedMove) {
                        case 'K' :
                            $this->_moveAlgebraic("e$row", "g$row");
                            $this->_moveAlgebraic("h$row", "f$row");
                        break;
                        case 'Q' :
                            $this->_moveAlgebraic("e$row", "c$row");
                            $this->_moveAlgebraic("a$row", "d$row");
                        break;
                    }
                    $this->_enPassantSquare = '-';
                } else {
                    $movedfrom = $this->_getSquareFromParsedMove($parsedMove);
                    $promote = isset($parsedMove['promote']) ?
                        $parsedMove['promote'] : '';
                    $this->_moveAlgebraic($movedfrom, $parsedMove['square'], $promote);
                    if ($parsedMove['takes']) {
                        $this->_halfMoves = 1;
                    }
                    if ($parsedMove['piece'] == 'P') {
                        $this->_halfMoves = 1;
                        $this->_enPassantSquare = '-';
                        if (in_array($movedfrom{1} - $parsedMove['square']{1},
                              array(2, -2))) {
                            $direction = ($this->_move == 'W' ? 1 : -1);
                            $this->_enPassantSquare = $parsedMove['square']{0} .
                                ($parsedMove['square']{1} - $direction);
                        }
                    } else {
                        $this->_enPassantSquare = '-';
                    }
                    if ($parsedMove['piece'] == 'K') {
                        $this->{'_' . $this->_move . 'CastleQ'} = false;
                        $this->{'_' . $this->_move . 'CastleK'} = false;
                    }
                    if ($parsedMove['piece'] == 'R') {
                        if ($movedfrom{0} == 'a') {
                        $this->{'_' . $this->_move . 'CastleQ'} = false;
                        }
                        if ($movedfrom{0} == 'h') {
                        $this->{'_' . $this->_move . 'CastleK'} = false;
                        }
                    }
                }
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
    
    /**
     * Move a piece from one square to another, and mark the old square as empty
     *
     * @param string [a-h][1-8] square to move from
     * @param string [a-h][1-8] square to move to
     * @param string piece to promote to, if this is a promotion move
     * @return true|PEAR_Error
     */
    function moveSquare($from, $to, $promote = '')
    {
        $move = $this->_convertSquareToSAN($from, $to, $promote);
        if ($this->isError($move)) {
            return $move;
        } else {
            return $this->moveSAN($move);
        }
    }
    
    /**
     * Get the list of moves in Standard Algebraic Notation
     *
     * Can be used to populate a PGN file.
     * @param boolean If true, then moves that check will be postfixed with "+" and checkmate with "#"
     *                as in Nf3+ or Qxg7#
     * @return array
     */
    function getMoveList($withChecks = false)
    {
        if ($withChecks) {
            return $this->_movesWithCheck;
        }
        return $this->_moves;
    }
    
    /**
     * @return W|B|D|false winner of game, or draw, or false if still going
     */
    function gameOver()
    {
        $opposite = $this->_move == 'W' ? 'B' : 'W';
        if ($this->inCheckmate()) {
            return $opposite;
        }
        if ($this->inDraw()) {
            return 'D';
        }
        return false;
    }
    
    /**
     * Determine whether a side is in checkmate
     * @param W|B color of side to check, defaults to the current side
     * @return boolean
     * @throws GAMES_CHESS_ERROR_INVALID_COLOR
     */
    function inCheckMate($color = null)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        if (!($checking = $this->inCheck($color))) {
            return false;
        }
        $moves = $this->getPossibleKingMoves($king = $this->_getKing($color), $color);
        foreach ($moves as $escape) {
            $this->startTransaction();
            $this->_move = $color;
            $this->moveSquare($king, $escape);
            $this->_move = $color;
            $stillchecked = $this->inCheck($color);
            $this->rollbackTransaction();
            if (!$stillchecked) {
                return false;
            }
        }
        // if we're in double check, and the king can't move, that's checkmate
        if (is_array($checking) && count($checking) > 1) {
            return true;
        }
        $squares = $this->_getPathToKing($checking, $king);
        if ($this->_interposeOrCapture($squares, $color)) {
            return false;
        }
        return true;
    }
    
    /**
     * Determine whether a side is in stalemate
     * @param W|B color of the side to look at, defaults to the current side
     * @return boolean
     * @throws GAMES_CHESS_ERROR_INVALID_COLOR
     */
    function inStaleMate($color = null)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        if ($this->inCheck($color)) {
            return false;
        }
        $moves = $this->_getPossibleChecks($color);
        foreach($moves as $name => $canmove) {
            if (count($canmove)) {
                $a = $this->_getPiece($name);
                foreach($canmove as $move) {
                    $this->startTransaction();
                    $this->_move = $color;
                    $err = $this->moveSquare($a, $move);
                    $this->rollbackTransaction();
                    if (!is_object($err)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
    
    /**
     * Determines the presence of a forced draw
     * @param W|B
     * @return boolean
     */
    function inDraw($color = null)
    {
        return $this->inStaleMate($color) ||
               $this->inRepetitionDraw() ||
               $this->in50MoveDraw() ||
               $this->inBasicDraw();
    }
    
    /**
     * Determine whether draw by repetition has happened
     *
     * From FIDE rules:
     * <pre>
     * 10.10
     *
     * The game is drawn, upon a claim by the player having the move, when the
     * same position, for the third time: 
     * (a) is about to appear, if he first writes the move on his
     *     scoresheet and declares to the arbiter his intention of making
     *     this move; or 
     * (b) has just appeared, the same player having the move each time. 
     *
     * The position is considered the same if pieces of the same kind and
     * colour occupy the same squares, and if all the possible moves of
     * all the pieces are the same, including the rights to castle [at
     * some future time] or to capture a pawn "en passant". 
     * </pre>
     *
     * This class determines draw by comparing FENs rendered after every move
     * @return boolean
     */
    function inRepetitionDraw()
    {
        $fen = $this->renderFen(false);
        if (isset($this->_allFENs[$fen]) && $this->_allFENs[$fen] == 3) {
            return true;
        }
        return false;
    }
    
    /**
     * Determine whether any pawn move or capture has occurred in the past 50 moves
     * @return boolean
     */
    function in50MoveDraw()
    {
        return $this->_halfMoves >= 50;
    }
    
    /**
     * Determine the presence of a basic draw as defined by FIDE rules
     *
     * The rule states:
     * <pre>
     * 10.4
     *
     * The game is drawn when one of the following endings arises: 
     * (a) king against king; 
     * (b) king against king with only bishop or knight; 
     * (c) king and bishop against king and bishop, with both bishops
     *     on diagonals of the same colour. 
     * </pre>
     * @return boolean
     */
    function inBasicDraw()
    {
        $pieces = $this->_getPieceTypes();
        $blackpieces = array_keys($pieces['B']);
        $whitepieces = array_keys($pieces['W']);
        if (count($blackpieces) > 2 || count($whitepieces) > 2) {
            return false;
        }
        if (count($blackpieces) == 1) {
            if (count($whitepieces) == 1) {
                return true;
            }
            if ($whitepieces[0] == 'K') {
                if (in_array($whitepieces[1], array('N', 'B'))) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if (in_array($whitepieces[0], array('N', 'B'))) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        if (count($whitepieces) == 1) {
            if (count($blackpieces) == 1) {
                return true;
            }
            if ($blackpieces[0] == 'K') {
                if (in_array($blackpieces[1], array('N', 'B'))) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if (in_array($blackpieces[0], array('N', 'B'))) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        $wpindex = ($whitepieces[0] == 'K') ? 1 : 0;
        $bpindex = ($blackpieces[0] == 'K') ? 1 : 0;
        if ($whitepieces[$wpindex] == 'B' && $blackpieces[$bpindex] == 'B') {
            // bishops of same color?
            if ($pieces['B']['B'][0] == $pieces['W']['B'][0]) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * render the FEN notation for the current board
     * @param boolean private parameter, used to determine whether to include
     *                move number/ply count - this is used to keep track of
     *                positions for draw detection
     * @return string
     */
    function renderFen($include_moves = true)
    {
        $fen = $this->_renderFen() . ' ';
        
        // render who's to move
        $fen .= strtolower($this->_move) . ' ';
        
        // render castling rights
        if (!$this->_WCastleQ && !$this->_WCastleK && !$this->_BCastleQ
              && !$this->_BCastleK) {
            $fen .= '- ';
        } else {
            if ($this->_WCastleK) {
                $fen .= 'K';
            }
            if ($this->_WCastleQ) {
                $fen .= 'Q';
            }
            if ($this->_BCastleK) {
                $fen .= 'k';
            }
            if ($this->_BCastleQ) {
                $fen .= 'q';
            }
            $fen .= ' ';
        }
        
        // render en passant square
        $fen .= $this->_enPassantSquare;

        if (!$include_moves) {
            return $fen;
        }

        // render half moves since last pawn move or capture
        $fen .=  ' ' . $this->_halfMoves . ' ';
        
        // render move number
        $fen .= $this->_moveNumber;
        return $fen;
    }
    
    /**
     * Add a piece to the chessboard
     *
     * Must be overridden in child classes
     * @abstract
     * @param W|B Color of piece
     * @param P|N|K|Q|R|B Piece type
     * @param string algebraic location of piece
     */
    function addPiece($color, $type, $square)
    {
        trigger_error("Error: do not use abstract Games_Chess class", E_USER_ERROR);
    }
    
    /**
     * Generate a representation of the chess board and pieces for use as a
     * direct translation to a visual chess board
     *
     * Must be overridden in child classes
     * @return array
     * @abstract
     */
    function toArray()
    {
        trigger_error("Error: do not use abstract Games_Chess class", E_USER_ERROR);
    }
    
    /**
     * Determine whether moving a piece from one square to another requires
     * a pawn promotion
     * @param string [a-h][1-8] location of the piece to move
     * @param string [a-h][1-8] place to move the piece to
     * @return boolean true if the move represented by moving from $from to $to
     *                 is a pawn promotion move
     */
    function isPromoteMove($from, $to)
    {
        $test = $this->_convertSquareToSAN($from, $to);
        if ($this->isError($test)) {
            return false;
        }
        if (strpos($test, '=Q') !== false) {
            return true;
        }
        return false;
    }
    
    /**
     * @return W|B return the color of the side to move (white or black)
     */
    function toMove()
    {
        return $this->_move;
    }
    
    /**
     * Determine legality of kingside castling
     * @return boolean
     */
    function canCastleKingside()
    {
        return $this->{'_' . $this->_move . 'CastleK'};
    }
    
    
    /**
     * Determine legality of queenside castling
     * @return boolean
     */
    function canCastleQueenside()
    {
        return $this->{'_' . $this->_move . 'CastleQ'};
    }
    
    /**
     * Move a piece from one square to another, and mark the old square as empty
     *
     * NO validation is performed, use {@link moveSquare()} for validation.
     *
     * @param string [a-h][1-8] square to move from
     * @param string [a-h][1-8] square to move to
     * @param string piece to promote to, if this is a promotion move
     * @access protected
     */
    function _moveAlgebraic($from, $to, $promote = '')
    {
        if ($to == $this->_enPassantSquare && $this->isPawn($this->_board[$from])) {
            $rank = ($to{1} == '3') ? '4' : '5';
            // this piece was just taken
            $this->_takePiece($to{0} . $rank);
            $this->_board[$to{0} . $rank] = $to{0} . $rank;
        }
        if ($this->_board[$to] != $to) {
            // this piece was just taken
            $this->_takePiece($to);
        }
        // mark the piece as moved
        $this->_movePiece($from, $to, $promote);
        $this->_board[$to] = $this->_board[$from];
        $this->_board[$from] = $from;
    }
    
    /**
     * Parse out the segments of a move (minus any annotations)
     * @param string
     * @return array
     * @access protected
     */
    function _parseMove($move)
    {
        if ($move == 'O-O') {
            return array(GAMES_CHESS_CASTLE => 'K');
        }
        if ($move == 'O-O-O') {
            return array(GAMES_CHESS_CASTLE => 'Q');
        }
        // pawn moves
        if (preg_match('/^P?(([a-h])([1-8])?(x))?([a-h][1-8])(=([QRNB]))?$/', $move, $match)) {
            if ($match[2]) {
                $takesfrom = $match[2]{0};
            } else {
                $takesfrom = '';
            }
            $res = array(
                'takesfrom' => $takesfrom,
                'takes' => $match[4],
                'disambiguate' => '',
                'square' => $match[5],
                'promote' => '',
                'piece' => 'P',
            );
            if (isset($match[7])) {
                $res['promote'] = $match[7];
            }
            return array(GAMES_CHESS_PAWNMOVE => $res);
        // piece moves
        } elseif (preg_match('/^(K)(x)?([a-h][1-8])$/', $move, $match)) {
            $res = array(
                'takesfrom' => false,
                'piece' => $match[1],
                'disambiguate' => '',
                'takes' => $match[2],
                'square' => $match[3],
            );
            return array(GAMES_CHESS_PIECEMOVE => $res);
        } elseif (preg_match('/^([QRBN])([a-h]|[1-8]|[a-h][1-8])?(x)?([a-h][1-8])$/', $move, $match)) {
            $res = array(
                'takesfrom' => false,
                'piece' => $match[1],
                'disambiguate' => $match[2],
                'takes' => $match[3],
                'square' => $match[4],
            );
            return array(GAMES_CHESS_PIECEMOVE => $res);
        } elseif (preg_match('/^([QRBN])@([a-h][1-8])$/', $move, $match)) {
            $res = array(
                'piece' => $match[1],
                'square' => $match[2],
            );
            return array(GAMES_CHESS_PIECEPLACEMENT => $res);
        // error
        } elseif (preg_match('/^([P])@([a-h][2-7])$/', $move, $match)) {
            $res = array(
                'piece' => $match[1],
                'square' => $match[2],
            );
            return array(GAMES_CHESS_PIECEPLACEMENT => $res);
        // error
        } elseif (preg_match('/^([P])@([a-h][18])$/', $move, $match)) {
            return $this->raiseError(GAMES_CHESS_ERROR_CANT_PLACE_18, array('san' => $move));
        // error
        } else {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SAN,
                array('pgn' => $move));
        }
    }
    
    
    /**
     * Set up the board with the starting position
     *
     * Must be overridden in child classes
     * @abstract
     * @access protected
     */
    function _setupStartingPosition()
    {
        trigger_error("Error: do not use abstract Games_Chess class", E_USER_ERROR);
    }
    
    /**
     * Parse a Farnsworth-Edwards Notation (FEN) chessboard position string, and
     * set up the chessboard with this position
     * @param string
     * @access private
     */
    function _parseFen($fen)
    {
        $splitfen = explode(' ', $fen);
        if (count($splitfen) != 6) {
            return $this->raiseError(GAMES_CHESS_ERROR_FEN_COUNT,
                array('fen' => $fen, 'sections' => count($splitfen)));
        }

        foreach($splitfen as $index => $test) {
            if ($test == '') {
                return $this->raiseError(GAMES_CHESS_ERROR_EMPTY_FEN,
                    array('fen' => $fen, 'section' => $index));
            }
        }

        $this->blankBoard();
        $loc = 'a8';
        $idx = 0;
        $FEN = $splitfen[0];

        // parse position section
        while ($idx < strlen($FEN)) {
            $c = $FEN{$idx};
            switch ($c) {
                case "K" :
                case "Q" :
                case "R" :
                case "B" :
                case "N" :
                case "P" :
                    $err = $this->addPiece('W', $c, $loc);
                    if ($this->isError($err)) {
                        if ($err->getCode() == GAMES_CHESS_ERROR_MULTIPIECE) {
                            return $this->raiseError(GAMES_CHESS_ERROR_FEN_MULTIPIECE,
                            array('fen' => $fen, 'color' => 'W', 'piece' => $c));
                        } else {
                            return $err;
                        }
                    }
                break;
                case "k" :
                case "q" :
                case "r" :
                case "b" :
                case "n" :
                case "p" :
                    $err = $this->addPiece('B', strtoupper($c), $loc);
                    if ($this->isError($err)) {
                        if ($err->getCode() == GAMES_CHESS_ERROR_MULTIPIECE) {
                            return $this->raiseError(GAMES_CHESS_ERROR_FEN_MULTIPIECE,
                            array('fen' => $fen, 'color' => 'B', 'piece' => $c));
                        } else {
                            return $err;
                        }
                    }
                break;

                case "1" :
                case "2" :
                case "3" :
                case "4" :
                case "5" :
                case "6" :
                case "7" :
                case "8" :
                    $loc{0} = chr(ord($loc{0}) + ($c - 1));
                break;
                case "/" :
                    $loc{1} = $loc{1} - 1;
                    $loc{0} = 'a';
                    $idx++;
                    continue 2;
                break;
                default :
                    return $this->raiseError(GAMES_CHESS_ERROR_FEN_INVALIDPIECE,
                        array('fen' => $fen, 'fenchar' => $c));
                break;
            }
            $idx++;
            $loc{0} = chr(ord($loc{0}) + 1);
            if (ord($loc{0}) > ord('h')) {
                if (strlen($FEN) > $idx && $FEN{$idx} != '/') {
                    return $this->raiseError(GAMES_CHESS_ERROR_FEN_TOOMUCH,
                        array('fen' => $fen));
                }
            }
        }
        if ($loc != 'i1') {
            return $this->raiseError(GAMES_CHESS_ERROR_FEN_TOOLITTLE,
                array('fen' => $fen));
        }

        // parse who's to move
        if (!in_array($splitfen[1], array('w', 'b', 'W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_FEN_TOMOVEWRONG,
                array('fen' => $fen, 'tomove' => $splitfen[1]));
        }
        $this->_move = strtoupper($splitfen[1]);

        // parse castling rights
        if (strlen($splitfen[2]) > 4) {
            return $this->raiseError(GAMES_CHESS_ERROR_FEN_CASTLETOOLONG,
                array('fen' => $fen, 'castle' => $splitfen[2]));
        }
        $this->_WCastleQ = false;
        $this->_WCastleK = false;
        $this->_BCastleQ = false;
        $this->_BCastleK = false;
        if ($splitfen[2] != '-') {
            for ($i = 0; $i < 4; $i++) {
                if ($i >= strlen($splitfen[2])) {
                    continue;
                }
                switch ($splitfen[2]{$i}) {
                    case 'K' :
                        $this->_WCastleK = true;
                    break;
                    case 'Q' :
                        $this->_WCastleQ = true;
                    break;
                    case 'k' :
                        $this->_BCastleK = true;
                    break;
                    case 'q' :
                        $this->_BCastleQ = true;
                    break;
                    default:
                        return $this->raiseError(GAMES_CHESS_ERROR_FEN_CASTLEWRONG,
                            array('fen' => $fen, 'castle' => $splitfen[2]{$i}));
                    break;
                }
            }
        }

        // parse en passant square
        $this->_enPassantSquare = '-';
        if ($splitfen[3] != '-') {
            if (!preg_match('/^[a-h][36]$/', $splitfen[3])) {
                return $this->raiseError(GAMES_CHESS_ERROR_FEN_INVALID_EP,
                    array('fen' => $fen, 'enpassant' => $splitfen[3]));
            }
            $this->_enPassantSquare = $splitfen[3];
        }

        // parse half moves since last pawn move or capture
        if (!is_numeric($splitfen[4])) {
            return $this->raiseError(GAMES_CHESS_ERROR_FEN_INVALID_PLY,
                array('fen' => $fen, 'ply' => $splitfen[4]));
        }
        $this->_halfMoves = $splitfen[4];

        // parse move number
        if (!is_numeric($splitfen[5])) {
            return $this->raiseError(GAMES_CHESS_ERROR_FEN_INVALID_MOVENUMBER,
                array('fen' => $fen, 'movenumber' => $splitfen[5]));
        }
        $this->_moveNumber = $splitfen[5];
        return true;
    }
    
    /**
     * Validate a move
     * @param array parsed move array from {@link _parsedMove()}
     * @return true|PEAR_Error
     * @throws GAMES_CHESS_ERROR_IN_CHECK
     * @throws GAMES_CHESS_ERROR_CANT_CK
     * @throws GAMES_CHESS_ERROR_CK_PIECES_IN_WAY
     * @throws GAMES_CHESS_ERROR_CANT_CQ
     * @throws GAMES_CHESS_ERROR_CQ_PIECES_IN_WAY
     * @throws GAMES_CHESS_ERROR_CASTLE_WOULD_CHECK
     * @throws GAMES_CHESS_ERROR_CANT_CAPTURE_OWN
     * @throws GAMES_CHESS_ERROR_STILL_IN_CHECK
     * @throws GAMES_CHESS_ERROR_MOVE_WOULD_CHECK
     * @access protected
     */
    function _validMove($move)
    {
        list($type, $info) = each($move);
        $this->startTransaction();
        $valid = false;
        switch ($type) {
            case GAMES_CHESS_CASTLE :
                if ($this->inCheck($this->_move)) {
                    $this->rollbackTransaction();
                    return $this->raiseError(GAMES_CHESS_ERROR_IN_CHECK);
                }
                if ($info == 'K') {
                    if ($this->_move == 'W') {
                        if (!$this->_WCastleK) {
                            $this->rollbackTransaction();
                            return $this->raiseError(GAMES_CHESS_ERROR_CANT_CK);
                        }
                        if ($this->_board['f1'] != 'f1' || $this->_board['g1'] != 'g1') {
                            $this->rollbackTransaction();
                            return $this->raiseError(GAMES_CHESS_ERROR_CK_PIECES_IN_WAY);
                        }
                        $kingsquares = array('f1', 'g1');
                        $on = 'e1';
                    } else {
                        if (!$this->_BCastleK) {
                            $this->rollbackTransaction();
                            return $this->raiseError(GAMES_CHESS_ERROR_CANT_CK);
                        }
                        if ($this->_board['f8'] != 'f8' || $this->_board['g8'] != 'g8') {
                            $this->rollbackTransaction();
                            return $this->raiseError(GAMES_CHESS_ERROR_CK_PIECES_IN_WAY);
                        }
                        $kingsquares = array('f8', 'g8');
                        $on = 'e8';
                    }
                } else {
                    if ($this->_move == 'W') {
                        if (!$this->_WCastleQ) {
                            $this->rollbackTransaction();
                            return $this->raiseError(GAMES_CHESS_ERROR_CANT_CQ);
                        }
                        if ($this->_board['d1'] != 'd1' ||
                              $this->_board['c1'] != 'c1' ||
                              $this->_board['b1'] != 'b1') {
                            $this->rollbackTransaction();
                            return $this->raiseError(GAMES_CHESS_ERROR_CQ_PIECES_IN_WAY);
                        }
                        $kingsquares = array('d1', 'c1');
                        $on = 'e1';
                    } else {
                        if (!$this->_BCastleQ) {
                            $this->rollbackTransaction();
                            return $this->raiseError(GAMES_CHESS_ERROR_CANT_CQ);
                        }
                        if ($this->_board['d8'] != 'd8' ||
                              $this->_board['c8'] != 'c8' ||
                              $this->_board['b8'] != 'b8') {
                            $this->rollbackTransaction();
                            return $this->raiseError(GAMES_CHESS_ERROR_CQ_PIECES_IN_WAY);
                        }
                        $kingsquares = array('d8', 'c8');
                        $on = 'e8';
                    }
                }
                
                // check every square the king could move to and make sure
                // we wouldn't be in check
                foreach ($kingsquares as $square) {
                    $this->_moveAlgebraic($on, $square);
                    if ($this->inCheck($this->_move)) {
                        $this->rollbackTransaction();
                        return $this->raiseError(GAMES_CHESS_ERROR_CASTLE_WOULD_CHECK);
                    }
                    $on = $square;
                }
                $valid = true;
            break;
            case GAMES_CHESS_PIECEMOVE :
            case GAMES_CHESS_PAWNMOVE :
                if (!$this->isError($piecesq = $this->_getSquareFromParsedMove($info))) {
                    $wasinCheck = $this->inCheck($this->_move);
                    $piece = $this->_board[$info['square']];
                    if ($info['takes'] && $this->_board[$info['square']] ==
                          $info['square']) {
                        if (!($info['square'] == $this->_enPassantSquare &&
                              $info['piece'] == 'P')) {
                            return $this->raiseError(GAMES_CHESS_ERROR_NO_PIECE,
                                array('square' => $info['square']));
                        }
                    }
                    $this->_moveAlgebraic($piecesq, $info['square']);
                    $valid = !$this->inCheck($this->_move);
                    if ($wasinCheck && !$valid) {
                        $this->rollbackTransaction();
                        return $this->raiseError(GAMES_CHESS_ERROR_STILL_IN_CHECK);
                    } elseif (!$valid) {
                        $this->rollbackTransaction();
                        return $this->raiseError(GAMES_CHESS_ERROR_MOVE_WOULD_CHECK);
                    }
                } else {
                    $this->rollbackTransaction();
                    return $piecesq;
                }
            break;
        }
        $this->rollbackTransaction();
        return $valid;
    }
    
    /**
     * Convert a starting and ending algebraic square into SAN
     * @access protected
     * @param string [a-h][1-8] square piece is on
     * @param string [a-h][1-8] square piece moves to
     * @param string Q|R|B|N
     * @return string|PEAR_Error
     * @throws GAMES_CHESS_ERROR_INVALID_PROMOTE
     * @throws GAMES_CHESS_ERROR_INVALID_SQUARE
     * @throws GAMES_CHESS_ERROR_NO_PIECE
     * @throws GAMES_CHESS_ERROR_WRONG_COLOR
     * @throws GAMES_CHESS_ERROR_CANT_MOVE_THAT_WAY
     */
    function _convertSquareToSAN($from, $to, $promote = '')
    {
        if ($promote == '') {
            $promote = 'Q';
        }
        $promote = strtoupper($promote);
        if (!in_array($promote, array('Q', 'B', 'N', 'R'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_PROMOTE,
                array('piece' => $promote));
        }
        $SAN = '';
        if (!preg_match('/^[a-h][1-8]$/', $from)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $from));
        }
        if (!preg_match('/^[a-h][1-8]$/', $to)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $to));
        }
        $piece = $this->_squareToPiece($from);
        if (!$piece) {
            return $this->raiseError(GAMES_CHESS_ERROR_NO_PIECE,
                array('square' => $from));
        }
        if ($piece['color'] != $this->_move) {
            return $this->raiseError(GAMES_CHESS_ERROR_WRONG_COLOR,
                array('square' => $from));
        }
        $moves = $this->getPossibleMoves($piece['piece'], $from, $piece['color']);
        if (!in_array($to, $moves)) {
            return $this->raiseError(GAMES_CHESS_ERROR_CANT_MOVE_THAT_WAY,
                array('from' => $from, 'to' => $to));
        }
        if ($piece['piece'] == 'K' && !in_array($to, $this->_getKingSquares($from))) {
            // this is a castling attempt
            if ($to{0} == 'g') {
                return 'O-O';
            } else {
                return 'O-O-O';
            }
        }
        $others = array();
        if ($piece['piece'] != 'K' && $piece['piece'] != 'P') {
            $others = $this->_getAllPieceSquares($piece['piece'],
                                                 $piece['color'], $from);
        }
        $disambiguate = '';
        $ambiguous = array();
        if (count($others)) {
            foreach ($others as $square) {
                if (in_array($to, $this->getPossibleMoves($piece['piece'], $square,
                                                          $piece['color']))) {
                    // other pieces can move to this square - need to disambiguate
                    $ambiguous[] = $square;
                }
            }
        }
        if (count($ambiguous) == 1) {
            if ($ambiguous[0]{0} != $from{0}) {
                $disambiguate = $from{0};
            } elseif ($ambiguous[0]{1} != $from{1}) {
                $disambiguate = $from{1};
            } else {
                $disambiguate = $from;
            }
        } elseif (count($ambiguous)) {
            $disambiguate = $from;
        }
        if ($piece['piece'] == 'P') {
            if ($from{0} != $to{0}) {
                $SAN = $from{0};
            }
        } else {
            $SAN = $piece['piece'];
        }
        $SAN .= $disambiguate;
        if ($this->_board[$to] != $to) {
            $SAN .= 'x';
        } else {
            if ($piece['piece'] == 'P' && $to == $this->_enPassantSquare) {
                $SAN .= 'x';
            }
        }
        $SAN .= $to;
        if ($piece['piece'] == 'P' && ($to{1} == '1' || $to{1} == '8')) {
            $SAN .= '=' . $promote;
        }
        return $SAN;
    }
    
    /**
     * Get a list of all possible theoretical squares a piece of this nature
     * and color could move to with the current board and game setup.
     *
     * This method will return all valid moves without determining the presence
     * of check
     * @param K|P|Q|R|B|N Piece name
     * @param string [a-h][1-8] algebraic location of the piece
     * @param B|W color of the piece
     * @param boolean Whether to return shortcut king moves for castling
     * @return array|PEAR_Error
     * @throws GAMES_CHESS_ERROR_INVALID_COLOR
     * @throws GAMES_CHESS_ERROR_INVALID_SQUARE
     * @throws GAMES_CHESS_ERROR_INVALID_PIECE
     */
    function getPossibleMoves($piece, $square, $color = null, $returnCastleMoves = true)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        if (!preg_match('/^[a-h][1-8]$/', $square)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $square));
        }
        $piece = strtoupper($piece);
        if (!in_array($piece, array('K', 'Q', 'B', 'N', 'R', 'P'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_PIECE,
                array('piece' => $piece));
        }
        switch ($piece) {
            case 'K' :
                return $this->getPossibleKingMoves($square, $color, $returnCastleMoves);
            break;
            case 'Q' :
                return $this->getPossibleQueenMoves($square, $color);
            break;
            case 'B' :
                return $this->getPossibleBishopMoves($square, $color);
            break;
            case 'N' :
                return $this->getPossibleKnightMoves($square, $color);
            break;
            case 'R' :
                return $this->getPossibleRookMoves($square, $color);
            break;
            case 'P' :
                return $this->getPossiblePawnMoves($square, $color);
            break;
        }
    }
    
    /**
     * Get the set of squares that are diagonals from this square on an empty board.
     *
     * WARNING: assumes valid input
     * @param string [a-h][1-8]
     * @param boolean if true, simply returns an array of all squares
     * @return array Format:
     *
     * <pre>
     * array(
     *   'NE' => array(square, square),
     *   'NW' => array(square, square),
     *   'SE' => array(square, square),
     *   'SW' => array(square, square)
     * )
     * </pre>
     *
     * Think of the diagonal directions as on a map.  squares are listed with
     * closer squares first
     */
    function _getDiagonals($square, $returnFlatArray = false)
    {
        $nw = ($square{0} != 'a') && ($square{1} != '8');
        $ne = ($square{0} != 'h') && ($square{1} != '8');
        $sw = ($square{0} != 'a') && ($square{1} != '1');
        $se = ($square{0} != 'h') && ($square{1} != '1');
        if ($nw) {
            $nw = array();
            $i = $square;
            while(ord($i{0}) > ord('a') && ord($i{1}) < ord('8')) {
                $i{0} = chr(ord($i{0}) - 1);
                $i{1} = chr(ord($i{1}) + 1);
                $nw[] = $i;
            }
        }
        if ($ne) {
            $ne = array();
            $i = $square;
            while(ord($i{0}) < ord('h') && ord($i{1}) < ord('8')) {
                $i{0} = chr(ord($i{0}) + 1);
                $i{1} = chr(ord($i{1}) + 1);
                $ne[] = $i;
            }
        }
        if ($sw) {
            $sw = array();
            $i = $square;
            while(ord($i{0}) > ord('a') && ord($i{1}) > ord('1')) {
                $i{0} = chr(ord($i{0}) - 1);
                $i{1} = chr(ord($i{1}) - 1);
                $sw[] = $i;
            }
        }
        if ($se) {
            $se = array();
            $i = $square;
            while(ord($i{0}) < ord('h') && ord($i{1}) > ord('1')) {
                $i{0} = chr(ord($i{0}) + 1);
                $i{1} = chr(ord($i{1}) - 1);
                $se[] = $i;
            }
        }
        if ($returnFlatArray) {
            if (!$nw) {
                $nw = array();
            }
            if (!$sw) {
                $sw = array();
            }
            if (!$ne) {
                $ne = array();
            }
            if (!$se) {
                $se = array();
            }
            return array_merge($ne, array_merge($nw, array_merge($se, $sw)));
        }
        return array('NE' => $ne, 'NW' => $nw, 'SE' => $se, 'SW' => $sw);
    }
    
    /**
     * Get the set of squares that are diagonals from this square on an empty board.
     *
     * WARNING: assumes valid input
     * @param string [a-h][1-8]
     * @param boolean if true, simply returns an array of all squares
     * @return array Format:
     *
     * <pre>
     * array(
     *   'N' => array(square, square),
     *   'E' => array(square, square),
     *   'S' => array(square, square),
     *   'W' => array(square, square)
     * )
     * </pre>
     *
     * Think of the horizontal directions as on a map.  squares are listed with
     * closer squares first
     * @access protected
     */
    function _getRookSquares($square, $returnFlatArray = false)
    {
        $n = ($square{1} != '8');
        $e = ($square{0} != 'h');
        $s = ($square{1} != '1');
        $w = ($square{0} != 'a');
        if ($n) {
            $n = array();
            $i = $square;
            while(ord($i{1}) < ord('8')) {
                $i{1} = chr(ord($i{1}) + 1);
                $n[] = $i;
            }
        }
        if ($e) {
            $e = array();
            $i = $square;
            while(ord($i{0}) < ord('h')) {
                $i{0} = chr(ord($i{0}) + 1);
                $e[] = $i;
            }
        }
        if ($s) {
            $s = array();
            $i = $square;
            while(ord($i{1}) > ord('1')) {
                $i{1} = chr(ord($i{1}) - 1);
                $s[] = $i;
            }
        }
        if ($w) {
            $w = array();
            $i = $square;
            while(ord($i{0}) > ord('a')) {
                $i{0} = chr(ord($i{0}) - 1);
                $w[] = $i;
            }
        }
        if ($returnFlatArray) {
            if (!$n) {
                $n = array();
            }
            if (!$s) {
                $s = array();
            }
            if (!$e) {
                $e = array();
            }
            if (!$w) {
                $w = array();
            }
            return array_merge($n, array_merge($s, array_merge($e, $w)));
        }
        return array('N' => $n, 'E' => $e, 'S' => $s, 'W' => $w);
    }
    
    /**
     * Get all the squares a queen could go to on a blank board
     *
     * WARNING: assumes valid input
     * @return array combines contents of {@link _getRookSquares()} and
     *               {@link _getDiagonals()}
     * @param string [a-h][1-8]
     * @param boolean if true, simply returns an array of all squares
     * @access protected
     */
    function _getQueenSquares($square, $returnFlatArray = false)
    {
        return array_merge($this->_getRookSquares($square, $returnFlatArray),
                           $this->_getDiagonals($square, $returnFlatArray));
    }
    
    /**
     * Get all the squares a knight could move to on an empty board
     *
     * WARNING: assumes valid input
     * @param string [a-h][1-8]
     * @param boolean if true, simply returns an array of all squares
     * @return array Returns an array of all the squares organized by compass
     *               point, that a knight can go to.  These squares may be indexed
     *               by any of WNW, NNW, NNE, ENE, ESE, SSE, SSW or WSW, unless
     *               $returnFlatArray is true, in which case an array of squares
     *               is returned
     * @access protected
     */
    function _getKnightSquares($square, $returnFlatArray = false)
    {
        $squares = array();
        // west-northwest square
        if (ord($square{0}) > ord('b') && $square{1} < 8) {
            $squares['WNW'] = chr(ord($square{0}) - 2) . ($square{1} + 1);
        }
        // north-northwest square
        if (ord($square{0}) > ord('a') && $square{1} < 7) {
            $squares['NNW'] = chr(ord($square{0}) - 1) . ($square{1} + 2);
        }
        // north-northeast square
        if (ord($square{0}) < ord('h') && $square{1} < 7) {
            $squares['NNE'] = chr(ord($square{0}) + 1) . ($square{1} + 2);
        }
        // east-northeast square
        if (ord($square{0}) < ord('g') && $square{1} < 8) {
            $squares['ENE'] = chr(ord($square{0}) + 2) . ($square{1} + 1);
        }
        // east-southeast square
        if (ord($square{0}) < ord('g') && $square{1} > 1) {
            $squares['ESE'] = chr(ord($square{0}) + 2) . ($square{1} - 1);
        }
        // south-southeast square
        if (ord($square{0}) < ord('h') && $square{1} > 2) {
            $squares['SSE'] = chr(ord($square{0}) + 1) . ($square{1} - 2);
        }
        // south-southwest square
        if (ord($square{0}) > ord('a') && $square{1} > 2) {
            $squares['SSW'] = chr(ord($square{0}) - 1) . ($square{1} - 2);
        }
        // west-southwest square
        if (ord($square{0}) > ord('b') && $square{1} > 1) {
            $squares['WSW'] = chr(ord($square{0}) - 2) . ($square{1} - 1);
        }
        if ($returnFlatArray) {
            return array_values($squares);
        }
        return $squares;
    }
    
    /**
     * Get a list of all the squares a king could castle to on an empty board
     *
     * WARNING: assumes valid input
     * @param string [a-h][1-8]
     * @return array
     * @access protected
     * @since 0.7alpha
     */
    function _getCastleSquares($square)
    {
        $ret = array();
        if ($this->_move == 'W') {
            if ($square == 'e1' && $this->_WCastleK) {
                $ret[] = 'g1';
            }
            if ($square == 'e1' && $this->_WCastleQ) {
                $ret[] = 'c1';
            }

        } else {
            if ($square == 'e8' && $this->_BCastleK) {
                $ret[] = 'g8';
            }
            if ($square == 'e8' && $this->_BCastleQ) {
                $ret[] = 'c8';
            }
        }
        return $ret;
    }
    
    /**
     * Get a list of all the squares a king could move to on an empty board
     *
     * WARNING: assumes valid input
     * @param string [a-h][1-8]
     * @return array
     * @access protected
     */
    function _getKingSquares($square)
    {
        $squares = array();
        if (ord($square{0}) - ord('a')) {
            $squares[] = chr(ord($square{0}) - 1) . $square{1};
            if ($square{1} < 8) {
                $squares[] = chr(ord($square{0}) - 1) . ($square{1} + 1);
            }
            if ($square{1} > 1) {
                $squares[] = chr(ord($square{0}) - 1) . ($square{1} - 1);
            }
        }
        if (ord($square{0}) - ord('h')) {
            $squares[] = chr(ord($square{0}) + 1) . $square{1};
            if ($square{1} < 8) {
                $squares[] = chr(ord($square{0}) + 1) . ($square{1} + 1);
            }
            if ($square{1} > 1) {
                $squares[] = chr(ord($square{0}) + 1) . ($square{1} - 1);
            }
        }
        if ($square{1} > 1) {
            $squares[] = $square{0} . ($square{1} - 1);
        }
        if ($square{1} < 8) {
            $squares[] = $square{0} . ($square{1} + 1);
        }
        return $squares;
    }
    
    /**
     * Get the location of all pieces on the board of a certain color
     *
     * Default is the color that is about to move
     * @param W|B
     * @return array|PEAR_Error
     * @throws GAMES_CHESS_ERROR_INVALID_COLOR
     */
    function getPieceLocations($color = null)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        return $this->_getAllPieceLocations($color);
    }

    /**
     * Get the location of every piece on the board of color $color
     * @param W|B color of pieces to check
     * @return array
     * @abstract
     * @access protected
     */
    function _getAllPieceLocations($color)
    {
        trigger_error('Error: do not use abstract Games_Chess class', E_USER_ERROR);
    }
    
    /**
     * Get all legal Knight moves (checking of the king is not taken into account)
     * @param string [a-h][1-8] Location of piece
     * @param W|B color of piece, or null to use current piece to move
     * @return array
     */
    function getPossibleKnightMoves($square, $color = null)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        if (!preg_match('/^[a-h][1-8]$/', $square)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $square));
        }
        $allmoves = $this->_getKnightSquares($square);
        $mypieces = $this->getPieceLocations($color);
        return array_values(array_diff($allmoves, $mypieces));
    }
    
    /**
     * Get all legal Bishop moves (checking of the king is not taken into account)
     * @param string [a-h][1-8] Location of piece
     * @param W|B color of piece, or null to use current piece to move
     * @return array
     */
    function getPossibleBishopMoves($square, $color = null)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        if (!preg_match('/^[a-h][1-8]$/', $square)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $square));
        }
        $allmoves = $this->_getDiagonals($square);
        $mypieces = $this->getPieceLocations($color);
        foreach($mypieces as $loc) {
            // go through the diagonals, and remove squares behind our own pieces
            // and also remove the piece's square
            // as bishops cannot pass through any pieces.
            if (is_array($allmoves['NW']) && in_array($loc, $allmoves['NW'])) {
                $pos = array_search($loc, $allmoves['NW']);
                $allmoves['NW'] = array_slice($allmoves['NW'], 0, $pos);
            }
            if (is_array($allmoves['NE']) && in_array($loc, $allmoves['NE'])) {
                $pos = array_search($loc, $allmoves['NE']);
                $allmoves['NE'] = array_slice($allmoves['NE'], 0, $pos);
            }
            if (is_array($allmoves['SE']) && in_array($loc, $allmoves['SE'])) {
                $pos = array_search($loc, $allmoves['SE']);
                $allmoves['SE'] = array_slice($allmoves['SE'], 0, $pos);
            }
            if (is_array($allmoves['SW']) && in_array($loc, $allmoves['SW'])) {
                $pos = array_search($loc, $allmoves['SW']);
                $allmoves['SW'] = array_slice($allmoves['SW'], 0, $pos);
            }
        }
        $enemypieces = $this->getPieceLocations($color == 'W' ? 'B' : 'W');
        foreach($enemypieces as $loc) {
            // go through the diagonals, and remove squares behind enemy pieces
            // and include the piece's square, since we can capture it
            // but bishops cannot pass through any pieces.
            if (is_array($allmoves['NW']) && in_array($loc, $allmoves['NW'])) {
                $pos = array_search($loc, $allmoves['NW']);
                $allmoves['NW'] = array_slice($allmoves['NW'], 0, $pos + 1);
            }
            if (is_array($allmoves['NE']) && in_array($loc, $allmoves['NE'])) {
                $pos = array_search($loc, $allmoves['NE']);
                $allmoves['NE'] = array_slice($allmoves['NE'], 0, $pos + 1);
            }
            if (is_array($allmoves['SE']) && in_array($loc, $allmoves['SE'])) {
                $pos = array_search($loc, $allmoves['SE']);
                $allmoves['SE'] = array_slice($allmoves['SE'], 0, $pos + 1);
            }
            if (is_array($allmoves['SW']) && in_array($loc, $allmoves['SW'])) {
                $pos = array_search($loc, $allmoves['SW']);
                $allmoves['SW'] = array_slice($allmoves['SW'], 0, $pos + 1);
            }
        }
        $newmoves = array();
        foreach($allmoves as $key => $value) {
            if (!$value) {
                continue;
            }
            $newmoves = array_merge($newmoves, $value);
        }
        return array_values(array_diff($newmoves, $mypieces));
    }

    /**
     * Get all legal Rook moves (checking of the king is not taken into account)
     * @param string [a-h][1-8] Location of piece
     * @param W|B color of piece, or null to use current piece to move
     * @return array
     */
    function getPossibleRookMoves($square, $color = null)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        if (!preg_match('/^[a-h][1-8]$/', $square)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $square));
        }
        $allmoves = $this->_getRookSquares($square);
        $mypieces = $this->getPieceLocations($color);
        foreach($mypieces as $loc) {
            // go through the rook squares, and remove squares behind our own pieces
            // and also remove the piece's square
            // as rooks cannot pass through any pieces.
            if (is_array($allmoves['N']) && in_array($loc, $allmoves['N'])) {
                $pos = array_search($loc, $allmoves['N']);
                $allmoves['N'] = array_slice($allmoves['N'], 0, $pos);
            }
            if (is_array($allmoves['E']) && in_array($loc, $allmoves['E'])) {
                $pos = array_search($loc, $allmoves['E']);
                $allmoves['E'] = array_slice($allmoves['E'], 0, $pos);
            }
            if (is_array($allmoves['S']) && in_array($loc, $allmoves['S'])) {
                $pos = array_search($loc, $allmoves['S']);
                $allmoves['S'] = array_slice($allmoves['S'], 0, $pos);
            }
            if (is_array($allmoves['W']) && in_array($loc, $allmoves['W'])) {
                $pos = array_search($loc, $allmoves['W']);
                $allmoves['W'] = array_slice($allmoves['W'], 0, $pos);
            }
        }
        $enemypieces = $this->getPieceLocations($color == 'W' ? 'B' : 'W');
        foreach($enemypieces as $loc) {
            // go through the rook squares, and remove squares behind enemy pieces
            // and include the piece's square, since we can capture it
            // but rooks cannot pass through any pieces.
            if (is_array($allmoves['N']) && in_array($loc, $allmoves['N'])) {
                $pos = array_search($loc, $allmoves['N']);
                $allmoves['N'] = array_slice($allmoves['N'], 0, $pos + 1);
            }
            if (is_array($allmoves['E']) && in_array($loc, $allmoves['E'])) {
                $pos = array_search($loc, $allmoves['E']);
                $allmoves['E'] = array_slice($allmoves['E'], 0, $pos + 1);
            }
            if (is_array($allmoves['S']) && in_array($loc, $allmoves['S'])) {
                $pos = array_search($loc, $allmoves['S']);
                $allmoves['S'] = array_slice($allmoves['S'], 0, $pos + 1);
            }
            if (is_array($allmoves['W']) && in_array($loc, $allmoves['W'])) {
                $pos = array_search($loc, $allmoves['W']);
                $allmoves['W'] = array_slice($allmoves['W'], 0, $pos + 1);
            }
        }
        $newmoves = array();
        foreach($allmoves as $key => $value) {
            if (!$value) {
                continue;
            }
            $newmoves = array_merge($newmoves, $value);
        }
        return array_values(array_diff($newmoves, $mypieces));
    }
    
    /**
     * Get all legal Queen moves (checking of the king is not taken into account)
     * @param string [a-h][1-8] Location of piece
     * @param W|B color of piece, or null to use current piece to move
     * @return array
     */
    function getPossibleQueenMoves($square, $color = null)
    {
        $a = $this->getPossibleRookMoves($square, $color);
        $b = $this->getPossibleBishopMoves($square, $color);
        if ($this->isError($a)) {
            return $a;
        }
        if ($this->isError($b)) {
            return $b;
        }
        return array_merge($a, $b);
    }
    
    /**
     * Get all legal Pawn moves (checking of the king is not taken into account)
     * @param string [a-h][1-8] Location of piece
     * @param W|B color of piece, or null to use current piece to move
     * @return array
     */
    function getPossiblePawnMoves($square, $color = null, $enpassant = null)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        if (!preg_match('/^[a-h][1-8]$/', $square)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $square));
        }
        if (is_null($enpassant)) {
            $enpassant = $this->_enPassantSquare;
        }
        $mypieces = $this->getPieceLocations($color);
        $enemypieces = $this->getPieceLocations($color == 'W' ? 'B' : 'W');
        $allmoves = array();
        if ($color == 'W') {
            $dbl = '2';
            $direction = 1;
            // en passant calculation
            if ($square{1} == '5' && in_array(ord($enpassant{0}) - ord($square{0}),
                                              array(1, -1))) {
                if (in_array(chr(ord($square{0}) - 1) . 5,
                             $enemypieces)) {
                    $allmoves[] = chr(ord($square{0}) - 1) . 6;
                }
                if (in_array(chr(ord($square{0}) + 1) . 5,
                             $enemypieces)) {
                    $allmoves[] = chr(ord($square{0}) + 1) . 6;
                }
            }
        } else {
            $dbl = '7';
            $direction = -1;
            // en passant calculation
            if ($square{1} == '4' && in_array(ord($enpassant{0}) - ord($square{0}),
                                              array(1, -1))) {
                if (in_array(chr(ord($square{0}) - 1) . 4,
                             $enemypieces)) {
                    $allmoves[] = chr(ord($square{0}) - 1) . 3;
                }
                if (in_array(chr(ord($square{0}) + 1) . 4,
                             $enemypieces)) {
                    $allmoves[] = chr(ord($square{0}) + 1) . 3;
                }
            }
        }
        if (!in_array($square{0} . ($square{1} + $direction), $mypieces) &&
            !in_array($square{0} . ($square{1} + $direction), $enemypieces))
        {
            $allmoves[] = $square{0} . ($square{1} + $direction);
        }
        if (count($allmoves) && $square{1} == $dbl) {
            if (!in_array($square{0} . ($square{1} + 2 * $direction), $mypieces) &&
                !in_array($square{0} . ($square{1} + 2 * $direction), $enemypieces))
            {
                $allmoves[] = $square{0} . ($square{1} + 2 * $direction);
            }
        }
        if (in_array(chr(ord($square{0}) - 1) . ($square{1} + $direction),
                     $enemypieces)) {
            $allmoves[] = chr(ord($square{0}) - 1) . ($square{1} + $direction);
        }
        if (in_array(chr(ord($square{0}) + 1) . ($square{1} + $direction),
                     $enemypieces)) {
            $allmoves[] = chr(ord($square{0}) + 1) . ($square{1} + $direction);
        }
        return $allmoves;
    }
    
    /**
     * Get all legal King moves (checking of the king is not taken into account)
     * @param string [a-h][1-8] Location of piece
     * @param W|B color of piece, or null to use current piece to move
     * @return array
     * @since 0.7alpha castling is possible by moving the king to the destination square
     */
    function getPossibleKingMoves($square, $color = null, $returnCastleMoves = true)
    {
        if (is_null($color)) {
            $color = $this->_move;
        }
        $color = strtoupper($color);
        if (!in_array($color, array('W', 'B'))) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_COLOR,
                array('color' => $color));
        }
        if (!preg_match('/^[a-h][1-8]$/', $square)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $square));
        }
        $newret = $castleret = array();
        $ret = $this->_getKingSquares($square);
        if ($returnCastleMoves) {
            $castleret = $this->_getCastleSquares($square);
        }
        $mypieces = $this->getPieceLocations($color);
        foreach ($ret as $square) {
            if (!in_array($square, $mypieces)) {
                $newret[] = $square;
            }
        }
        return array_merge($newret, $castleret);
    }
    
    /**
     * Return the color of a square (black or white)
     * @param string [a-h][1-8]
     * @access protected
     * @return B|W
     */
    function _getDiagonalColor($square)
    {
        $map = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => 6,
            'g' => 7, 'h' => 8);
        $rank = $map[$square{0}];
        $file = $square{1};
        $color = ($rank + $file) % 2;
        return $color ? 'W' : 'B';
    }
    
    function getDiagonalColor($square)
    {
        if (!preg_match('/^[a-h][1-8]$/', $square)) {
            return $this->raiseError(GAMES_CHESS_ERROR_INVALID_SQUARE,
                array('square' => $square));
        }
        return $this->_getDiagonalColor($square);
    }
    
    /**
     * Get all the squares between an attacker and the king where another
     * piece can interpose, or capture the checking piece
     *
     * @param string algebraic square of the checking piece
     * @param string algebraic square of the king
     */
    function _getPathToKing($checkee, $king)
    {
        if ($this->_isKnight($this->_board[$checkee])) {
            return array($checkee);
        } else {
            $path = array();
            // get all the paths 
            $kingpaths = $this->_getQueenSquares($king);
            foreach ($kingpaths as $subpath) {
                if (!$subpath) {
                    continue;
                }
                if (in_array($checkee, $subpath)) {
                    foreach ($subpath as $square) {
                        $path[] = $square;
                        if ($square == $checkee) {
                            return $path;
                        }
                    }
                }
            }
        }
    }
    
    /**
     * @param integer error code from {@link Chess.php}
     * @param array associative array of additional error message data
     * @uses PEAR::raiseError()
     * @return PEAR_Error
     */
    function raiseError($code, $extra = array())
    {
        require_once 'PEAR.php';
        return PEAR::raiseError($this->getMessage($code, $extra), $code,
            null, null, $extra);
    }
    
    /**
     * Get an error message from the code
     *
     * Future versions of this method will be multi-language
     * @return string
     * @param integer Error code
     * @param array extra information to pass for error message creation
     */
    function getMessage($code, $extra)
    {
        $messages = array(
            GAMES_CHESS_ERROR_INVALID_SAN =>
                '"%pgn%" is not a valid algebraic move',
            GAMES_CHESS_ERROR_FEN_COUNT =>
                'Invalid FEN - "%fen%" has %sections% fields, 6 is required',
            GAMES_CHESS_ERROR_EMPTY_FEN => 
                'Invalid FEN - "%fen%" has an empty field at index %section%',
            GAMES_CHESS_ERROR_FEN_TOOMUCH =>
                'Invalid FEN - "%fen%" has too many pieces for a chessboard',
            GAMES_CHESS_ERROR_FEN_TOMOVEWRONG =>
                'Invalid FEN - "%fen%" has invalid to-move indicator, must be "w" or "b"',
            GAMES_CHESS_ERROR_FEN_CASTLETOOLONG =>
                'Invalid FEN - "%fen%" the castling indicator (KQkq) is too long',
            GAMES_CHESS_ERROR_FEN_CASTLEWRONG =>
                'Invalid FEN - "%fen%" the castling indicator "%castle%" is invalid',
            GAMES_CHESS_ERROR_FEN_INVALID_EP =>
                'Invalid FEN - "%fen%" the en passant square indicator "%enpassant%" is invalid',
            GAMES_CHESS_ERROR_FEN_INVALID_PLY =>
                'Invalid FEN - "%fen%" the half-move ply count "%ply%" is not a number',
            GAMES_CHESS_ERROR_FEN_INVALID_MOVENUMBER =>
                'Invalid FEN - "%fen%" the move number "%movenumber%" is not a number',
            GAMES_CHESS_ERROR_IN_CHECK =>
                'The king is in check and that move does not prevent check',
            GAMES_CHESS_ERROR_CANT_CK =>
                'Can\'t castle kingside, either the king or rook has moved',
            GAMES_CHESS_ERROR_CK_PIECES_IN_WAY =>
                'Can\'t castle kingside, pieces are in the way',
            GAMES_CHESS_ERROR_CANT_CQ =>
                'Can\'t castle queenside, either the king or rook has moved',
            GAMES_CHESS_ERROR_CQ_PIECES_IN_WAY =>
                'Can\'t castle queenside, pieces are in the way',
            GAMES_CHESS_ERROR_CASTLE_WOULD_CHECK =>
                'Can\'t castle, it would put the king in check',
            GAMES_CHESS_ERROR_MOVE_WOULD_CHECK =>
                'That move would put the king in check',
            GAMES_CHESS_ERROR_STILL_IN_CHECK =>
                'The move does not remove the check on the king',
            GAMES_CHESS_ERROR_CANT_CAPTURE_OWN =>
                'Cannot capture your own pieces',
            GAMES_CHESS_ERROR_NO_PIECE =>
                'There is no piece on square %square%',
            GAMES_CHESS_ERROR_WRONG_COLOR =>
                'The piece on %square% is not your piece',
            GAMES_CHESS_ERROR_CANT_MOVE_THAT_WAY =>
                'The piece on %from% cannot move to %to%',
            GAMES_CHESS_ERROR_MULTIPIECE =>
                'Too many %color% %piece%s',
            GAMES_CHESS_ERROR_FEN_MULTIPIECE =>
                'Invalid FEN - "%fen%" Too many %color% %piece%s',
            GAMES_CHESS_ERROR_DUPESQUARE =>
                '%dpiece% already occupies square %square%, cannot be replaced by %piece%',
            GAMES_CHESS_ERROR_FEN_INVALIDPIECE =>
                'Invalid FEN - "%fen%" the character "%fenchar%" is not a valid piece, separator or number',
            GAMES_CHESS_ERROR_FEN_TOOLITTLE =>
                'Invalid FEN - "%fen%" has too few pieces for a chessboard',
            GAMES_CHESS_ERROR_INVALID_COLOR =>
                '"%color%" is not a valid piece color, try W or B',
            GAMES_CHESS_ERROR_INVALID_SQUARE =>
                '"%square%" is not a valid square, must be between a1 and h8',
            GAMES_CHESS_ERROR_INVALID_PIECE =>
                '"%piece%" is not a valid piece, must be P, Q, R, N, K or B',
            GAMES_CHESS_ERROR_INVALID_PROMOTE =>
                '"%piece%" is not a valid promotion piece, must be Q, R, N or B',
            GAMES_CHESS_ERROR_TOO_AMBIGUOUS =>
                '"%san%" does not resolve ambiguity between %piece%s on %squares%',
            GAMES_CHESS_ERROR_NOPIECE_CANDOTHAT =>
                'There are no %color% pieces on the board that can do "%san%"',
            GAMES_CHESS_ERROR_MOVE_MUST_CAPTURE =>
                'Capture is possible, "%san%" does not capture',
            GAMES_CHESS_ERROR_NOPIECES_TOPLACE =>
                'There are no captured %color% %piece%s available to place',
            GAMES_CHESS_ERROR_PIECEINTHEWAY =>
                'There is already a piece on %square%, cannot place another there',
            GAMES_CHESS_ERROR_CANT_PLACE_18 =>
                'Placing a piece on the first or back rank is illegal (%san%)',
        );
        $message = $messages[$code];
        foreach ($extra as $key => $value) {
            if (strpos($key, 'piece') !== false) {
                switch(strtoupper($value)) {
                    case 'R' :
                        $value = 'Rook';
                    break;
                    case 'Q' :
                        $value = 'Queen';
                    break;
                    case 'P' :
                        $value = 'Pawn';
                    break;
                    case 'B' :
                        $value = 'Bishop';
                    break;
                    case 'K' :
                        $value = 'King';
                    break;
                    case 'N' :
                        $value = 'Knight';
                    break;
                }
            }
            if ($key == 'color') {
                switch($value) {
                    case 'W' :
                        $value = 'White';
                    break;
                    case 'B' :
                        $value = 'Black';
                    break;
                }
            }
            $message = str_replace('%'.$key.'%', $value, $message);
        }
        return $message;
    }
    
    /**
     * Determines whether the data returned from a method is a PEAR-related
     * error class
     * @param mixed
     * @return boolean
     */
    function isError($err)
    {
        return is_a($err, 'PEAR_Error');
    }
    
    /**
     * Begin a chess piece transaction
     *
     * Transactions are used to attempt moves that may be revoked later, especially
     * in methods like {@link inCheckMate()}
     */
    function startTransaction()
    {
        $state = get_object_vars($this);
        unset($state['_saveState']);
        if (!is_array($this->_saveState)) {
            $this->_saveState = array();
        }
        array_push($this->_saveState, $state);
    }
    
    /**
     * Remove any possibility of undo.
     */
    function commitTransaction()
    {
        array_pop($this->_saveState);
    }
    
    /**
     * Undo any changes to state since {@link startTransaction()} was first used
     */
    function rollbackTransaction()
    {
        $vars = array_pop($this->_saveState);
        foreach($vars as $name => $value) {
            $this->$name = $value;
        }
    }
}
?>
