<?php
require_once 'Games/Chess/Standard.php';
require_once 'Games/Chess/Losers.php';
require_once 'Games/Chess/Crazyhouse.php';

if (!version_compare(phpversion(), '4.2.0', '>=')) {
    die('Requires PHP version 4.2.0 or greater');
}

// hack control
if (!isset($_GET['start']) || !is_string($_GET['start'])) {
    $_GET['start'] = '';
}
if (strlen($_GET['start']) != 2) {
    $_GET['start'] = '';
} elseif ($_GET['start'] != '' && !preg_match('/[a-h][1-8]/', $_GET['start'])) {
    $_GET['start'] = '';
}

if (!isset($_GET['goto']) || !is_string($_GET['goto'])) {
    $_GET['goto'] = '';
} elseif (strlen($_GET['goto']) != 2) {
    $_GET['goto'] = '';
} elseif (!preg_match('/[a-h][1-8]/', $_GET['goto'])) {
    $_GET['goto'] = '';
}

if (!empty($_GET['promote']) && !in_array($_GET['promote'], array('Q', 'R',
      'N', 'B'))) {
    $_GET['promote'] = 'Q';
}
/**
* Creates the game and maintains persistence through sessions
* Call this at the top of the webpage
* @param string name of the session containing the current game
* @param string name of the game variable (a {@link visualboard} class)
*/
function setup_game($session_id, $gamename)
{
    session_name($session_id);
    session_start();
    if (isset($_GET['newgame'])) {
        session_destroy();
    }
    session_name($session_id);
    session_register($gamename);
}

/**
 * The primary class - declare one of these at the top of the file
 *
 * Do it like this:
 *
 * <code>
 * setup_game('mygame','x');
 * $x = $_SESSION['x'];
 * if (!isset($x)) $x = new visualboard;
 * </code>
 * @author Greg Beaver <cellog@users.sourceforge.net>
 * @copyright Copyright 2002, Greg Beaver
 * @version 1.0
 */
class visualboard
{
    /**
     * The logical board
     * @var Games_Chess
     */
    var $_board;
    /**
     * Promotion contents
     * @var false|array
     */
    var $promote = false;
    /**
     * Game type (Standard, Losers, Crazyhouse)
     * @var string
     */
    var $_type;
    
    /**
     * Initializes {@link $moves, $board}
     */
    function visualboard($fen = false, $type = 'Standard')
    {
        $board = 'Games_Chess_' . $type;
        $this->_board = new $board;
        $this->_type = $type;
        $err = $this->_board->resetGame($fen);
        if ($this->_board->isError($err)) {
            echo '<b>' .$err->getMessage() . '</b><br />';
            $this->_board->resetGame();
        }
    }
    
    /**
     * Prints javascript for the function addmove:
     * {@source}
     */
    function javascript()
    {?>
<script language="JavaScript" type="text/javascript">
<!--
function addMove(move, piece)
{
    if (document.forms[0].start.value == '')
    {
        document.forms[0].start.value = move;
        switch (piece)
        {
            case "P" :
            case "Q" :
            case "R" :
            case "B" :
            case "N" :
            case "K" :
            break;
            default :
                piece = null;
            break;
        }
        document.forms[0].startpiece.value = piece;
    } else
    {
        if (document.forms[0]["goto"].value == '')
        {
            document.forms[0]["goto"].value = move;
            first = document.forms[0].startpiece.value;
            if (first) {
                if (first == "P") {
                    first = "";
                    if (piece) {
                        first = document.forms[0].start.value.charAt(0) + "x";
                    }
                } else {
                    if (piece) {
                        first += "x";
                    }
                }
            }
            if (confirm("Do this move? (" + first + move + ")"))
            {
                document.forms[0].submit();
            } else {
                document.forms[0].start.value = '';
                document.forms[0].startpiece.values = '';
                document.forms[0]["goto"].value = '';
                document.forms[0].SAN.value = '';
            }
        }
    }
}

function doPlacement(piece)
{
    switch (piece) {
        case "P" :
            name = "Pawn";
        break;
        case "Q" :
            name = "Queen";
        break;
        case "R" :
            name = "Rook";
        break;
        case "B" :
            name = "Bishop";
        break;
        case "N" :
            name = "Knight";
        break;
    }
    square = prompt("Where should the " + name + " be placed (a1-h8, a1 is lower left)?", "e4");
    if (square) {
        document.forms[0].SAN.value = piece + "@" + square;
        document.forms[0].start.value = "";
        document.forms[0]["goto"].value = "";
        if (square.charAt(1) == "1" || square.charAt(1) == "8") {
            document.forms[0].SAN.value = '';
            document.forms[0].start.value = "";
            document.forms[0]["goto"].value = "";
            alert("Cannot place a pawn on the first or last rank");
        } else {
            document.forms[0].submit();
        }
    }
}
//-->
</script>
<?php
    }

    function doCaptured($captured)
    {
        $imagepath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images';
        echo '<table border="1">';
//        echo '<tr><td>&nbsp;</td><td colspan="2">White</td><td colspan="2">Black</td></tr>';
        foreach ($captured['W'] as $piece => $number) {
            echo '<tr><td>';
            if (file_exists($imagepath . '/' . $piece . '.gif')) {
                $image = $piece . '.gif';
                $imgsize = GetImageSize($imagepath . DIRECTORY_SEPARATOR . $image);
                $click = ($this->_board->toMove() == 'W' && $number) ?
                    '<a href="#" onclick="doPlacement(\'' . $piece . '\')">' :
                    '';
                echo $click . '<img src="images/' . $image . '" border="0" width="' . $imgsize[0] .
                     '" height="' . $imgsize[1] . '" alt="'. $piece . '">';
                echo ($click ? '</a>' : '');
            } else {
                echo $piece;
            }
            echo '</td><td>' . $number . '</td>';
            $number = $captured['B'][$piece];
            echo '<td>';
            if (file_exists($imagepath . '/' . $piece . '.gif')) {
                $image = 'dark/' . $piece . '.gif';
                $imgsize = GetImageSize($imagepath . DIRECTORY_SEPARATOR . $image);
                $click = ($this->_board->toMove() == 'B' && $number) ?
                    '<a href="#" onclick="doPlacement(\'' . $piece . '\')">' :
                    '';
                echo $click . '<img src="images/' . $image . '" border="0" width="' . $imgsize[0] .
                     '" height="' . $imgsize[1] . '" alt="'. $piece . '">';
                echo ($click ? '</a>' : '');
            } else {
                echo $piece;
            }
            echo '</td><td>' . $number . '</td></tr>';
        }
        echo '</table>';
    }

    /**
     * Grabs the next move from form variables start, goto, kingcastle and queencastle
     *
     * If $_GET['start'] is not used, it checks for $_GET['kingcastle'] and tries
     * to castle kingside if found.  Otherwise, it looks for $_GET['queencastle']
     * and tries to castle queenside
     */
    function domove()
    {
        if (!empty($_GET['from']) && !empty($_GET['to']) && !empty($_GET['promote'])) {
            $err = $this->_board->moveSquare($_GET['from'], $_GET['to'],
                                             $_GET['promote']);
            if ($this->_board->isError($err)) {
                echo '<b>' .$err->getMessage() . '</b><br />';
            }
            $this->promote = false;
            return;
        }
        if (!empty($_GET['SAN'])) {
            $err = $this->_board->moveSAN($_GET['SAN']);
            if ($this->_board->isError($err)) {
                echo '<b>' .$err->getMessage() . '</b><br />';
            }
            return;
        }
        if (!empty($_GET['start']) && !empty($_GET['goto'])) {
            if ($this->_board->isPromoteMove($_GET['start'], $_GET['goto'])) {
                $this->promote = array($_GET['start'], $_GET['goto']);
                return;
            } else {
                $this->promote = false;
            }
            $err = $this->_board->moveSquare($_GET['start'], $_GET['goto']);
            if ($this->_board->isError($err)) {
                echo '<b>' .$err->getMessage() . '</b><br />';
            }
        } elseif (isset($_GET['kingcastle'])) {
            $err = $this->_board->moveSAN('O-O');
            if ($this->_board->isError($err)) {
                echo '<b>' .$err->getMessage() . '</b><br />';
            }
        } elseif (isset($_GET['queencastle'])) {
            $err = $this->_board->moveSAN('O-O-O');
            if ($this->_board->isError($err)) {
                echo '<b>' .$err->getMessage() . '</b><br />';
            }
        }
    }
    
    /**
     * This function prints the javascript that will ask the user what to promote the pawn to
     *
     * Using the alert() function, this method asks the user if they want a queen.
     * If they click Cancel, it asks if they want a rook, then knight, then
     * bishop.  If they cancel on bishop, it promotes to queen
     * to avoid any illogical possibilities
     */
    function dopromote()
    {
    ?>
<form action="<?php echo $_SERVER['PHP_SELF'].'?'.session_name().'='.session_id() ?>" name="chess" id="chess">
<input type="hidden" name="promote" value=""><input type="hidden" name="from" value="">
<input type="hidden" name="to" value="">
<input type="submit" name="newmove" value="New move"></form>
<script language="JavaScript" type="text/javascript">
<!--

function promote(from, to)
{
    document.forms[0].from.value = from;
    document.forms[0].to.value = to;
    if (confirm("promote to Queen?"))
    {
        document.forms[0].promote.value = 'Q';
        document.forms[0].submit();
    } else 
    {
        if (confirm("promote to Rook?"))
        {
            document.forms[0].promote.value = 'R';
            document.forms[0].submit();
        } else
        {
            if (confirm("promote to Knight?"))
            {
                document.forms[0].promote.value = 'N';
                document.forms[0].submit();
            } else
            {
                if (confirm("promote to Bishop?"))
                {
                    document.forms[0].promote.value = 'B';
                    document.forms[0].submit();
                } else
                {
                    document.forms[0].promote.value = 'Q';
                    document.forms[0].submit();
                }
            }
        }
    }
}
promote('<?php print $this->promote[0] . "', '" . $this->promote[1]; ?>');
//-->
</script>
<?php
    }
    
    /**
    * Print out the chess game in its entirety: the board, move list and control buttons
    *
    * first, it checks for a pawn promotion and adds the promote move to {@link $moves} using
    * {@link game::addpromote()}.  Then it moves the next piece by calling {@link domove()}.
    * Then it checks for stalemate and checkmate, and stops the gameplay if either condition is met.
    * It creates a visual representation of the board using {@link abstractboard::createrows()}, and
    * displays the chessboard by linking together the display of each row on the chessboard using
    * {@link row::draw()}, and finally the movelist using {@link game::draw()}
    */
    function draw()
    {
        $this->domove();
        if ($this->promote)
        {
            return $this->dopromote();
        }
        $board = $this->_board->toArray();
        if ($this->_type == 'Crazyhouse') {
            $captured = $board['captured'];
            $board = $board['board'];
        }
        $checkmate = $this->_board->inCheckmate();
        $fen = $this->_board->renderFen();
        $colors = array('#999933', '#FFFFFF');
        $textcolors = array('#FFFFFF', '#000000');
        $cycle = 0;
        if (!$checkmate) $this->javascript();
        echo '<table border="1">';
        $imagepath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images';
        foreach($board as $square => $piece) {
            if ($square{0} == 'a') {
                echo '<tr>';
                $cycle = ($cycle + 1) % 2;
            }
            echo '<td width="30" bgcolor="' .$colors[$cycle]. '"><font color="' .$textcolors[$cycle]. '">';
            $upperpiece = $piece ? strtoupper($piece) : false;
            echo "<a href=\"#\" onClick=\"addMove('$square', '$upperpiece');return false;" .
                "\" id=\"$square\">";


            if ($piece) {
                if (file_exists($imagepath . '/' . strtoupper($piece) . '.gif')) {
                    if ($piece != strtoupper($piece)) {
                        $image = 'dark/' . $piece . '.gif';
                    } else {
                        $image = $piece . '.gif';
                    }
                    $imgsize = GetImageSize($imagepath . DIRECTORY_SEPARATOR . $image);
                    echo '<img src="images/' . $image . '" border="0" width="' . $imgsize[0] .
                         '" height="' . $imgsize[1] . '" alt="'. $piece . '">';
                } else {
                    echo $piece;
                }
            } else {
                if (file_exists($imagepath . '/blank.gif')) {
                    if ($this->_board->getDiagonalColor($square) == 'W') {
                        $image = 'blank.gif';
                    } else {
                        $image = 'dark/blank.gif';
                    }
                    $imgsize = GetImageSize($imagepath . DIRECTORY_SEPARATOR . $image);
                    echo '<img src="images/' . $image . '" border="0" width="' . $imgsize[0] .
                         '" height="' . $imgsize[1] . '" alt="'. $piece . '">';
                } else {
                    echo '&nbsp;';
                }
            }
            echo '</a>';
            echo '</font></td>';
            if ($square{0} == 'h') {
                echo '</tr>';
            }
            $cycle = ($cycle + 1) % 2;
        }
        echo '</table>';

        $side = $this->_board->toMove() == 'W' ? 'White' : 'Black';
        $gameOver = $this->_board->gameOver();
        if ($gameOver) {
            $winner = $gameOver == 'W' ? 'White' : 'Black';
            if ($stalemate = $this->_board->inStalemate())
            {
                print "<h1>STALEMATE</h1>";
            } elseif ($draw = $this->_board->inDraw())
            {
                print "<h1>DRAW</h1>";
            } elseif ($this->_board->inCheckmate()) {
                if (!is_a($this->_board, 'games_chess_standard')) {
                    $winner = $side;
                } else {
                    $winner = ($side == 'White') ? 'Black' : 'White';
                }
                print "<h1>CHECKMATE! $winner WINS!</h1>";
            } else {
                print "<h1>$winner WINS!</h1>";
            }
        }

?><form action="<?php echo $_SERVER['PHP_SELF'].'?'.session_name().'='.session_id() ?>" name="chess" id="chess">
<?php         if (!$gameOver) { echo "<b>{$side} to move</b><br>";
if (isset($captured)) {
    echo "<b>Crazyhouse captured pieces available for placement:</b><br>";
    $this->doCaptured($captured);
}
 ?><input type="hidden" value="" name="startpiece">
from <input type="text" name="start" size="2" maxlength="2"> to <input type="text" name="goto" size="2" maxlength="2">
<input type="submit" name="newmove" value="New move"><br>
(alternate) SAN move: <input type="text" name="SAN" size="5"><br>
Reset with new FEN: <input type="text" name="FEN" size="70"><br>
<br><input type="reset"><br>
<?php $this->castlebutton(); } ?><br><br>

<input type="submit" name="newgame" value="New Game"><input type="submit" name="newlosergame" value="New Losers Game"><input type="submit" name="newcrazyhousegame" value="New Crazyhouse Game"></form><?php if (!$gameOver) { ?>
for a friend to join, click here <a href="mailto:example@example.com?Subject=Join my chess game!&Body=<?php
echo htmlentities("go to <a href=\"http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . 
"?mygame=".session_id()."\">Here</a> to play me in chess! http://$_SERVER[SERVER_NAME]$_SERVER[PHP_SELF]?mygame=" .
session_id()); ?>">Email my friend</a>

<form action="<?php echo $_SERVER['PHP_SELF'].'?'.session_name().'='.session_id() ?>">
<input type="submit" value="Check to see if opponent has moved"></form>
<?php }
        
        echo "<blockquote>Current position FEN: <strong>$fen</strong></blockquote>";
        $moves = $this->_board->getMoveList(true);
        echo '<table border="1"><th colspan="3" align="center">Moves</th><tr>' .
             '<td>#</td><td>White</td><td>Black</td></tr>';
        foreach($moves as $num => $moveset) {
            echo '<tr>';
            echo "<td>$num</td>";
            if (isset($moveset[0])) {
                echo "<td>$moveset[0]</td>";
            } else {
                echo "<td>&nbsp;</td>";
            }
            
            if (isset($moveset[1])) {
                echo "<td>$moveset[1]</td>";
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    
    /**
    * Prints the castling buttons after checking castling rights
    *
    * If castling rights have been taken away by a king or rook move, the button is not displayed.  This function
    * uses {@link Games_Chess::canCastleKingside(), Games_Chess::canCastleQueenside()} to find out.
    */
    function castlebutton()
    {
        if ($this->_board->canCastleKingside())
        echo '<input type="submit" name="kingcastle" value="Castle Your King Kingside">';
        if ($this->_board->canCastleQueenside())
        echo '<input type="submit" name="queencastle" value="Castle Your King Queenside">';
    }
}

setup_game('mygame','x');
$x = $_SESSION['x'];
$fen = isset($_GET['FEN']) ? $_GET['FEN'] : false;
if (!isset($x) || isset($_GET['newgame']) || $fen
      || isset($_GET['newlosergame']) || isset($_GET['newcrazyhousegame'])) {
    if (isset($_GET['newcrazyhousegame'])) {
        $x = new visualboard($fen, 'Crazyhouse');
    } elseif (isset($_GET['newlosergame'])) {
        $x = new visualboard($fen, 'Losers');
    } else {
        $x = new visualboard($fen, 'Standard');
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <title>PHP Chess!</title>
</head>

<body>
<h1>Welcome to <a href="http://www.chiaraquartet.net">The Chiara Quartet's</a> PHP Chess</h1>
<?php
$x->draw();
$_SESSION['x'] = $x;
?>


</body>
</html>


