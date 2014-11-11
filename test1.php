<?php
#--------------------------------------------------------------------------------------------------
# R. Urban 22.02.2014
#--------------------------------------------------------------------------------------------------
include "config.php";
#--------------------------------------------------------------------------------------------------
session_start();
$user ="";
$nick ="";
     if (!isset($_SESSION['nick'])){$_SESSION['nick']=$nick;}
     else {$user = $_SESSION['nick'];}
$zufall = rand(1,100);
if ($user==""){$user = "GUEST$zufall";}
#--------------------------------------------------------------------------------------------------
if ($botty){

$botty =<<<eof
setRequest_botty();
eof;
}
else {$botty ="";}
#--------------------------------------------------------------------------------------------------

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Genialchess - Blitz</title>


  <link rel="stylesheet" href="css/chessboard.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
}

#box1 {
	position: absolute;
	top: 11px;
	left: 495px;
	width: 683px;
}

#box2 {
	position: absolute;
	top: 396px;
	left: 496px;
	width: 103px;
}
#box3 {
	position: absolute;
	top: 292px;
	left: 155px;
	width: 60px;
}
.Stil2 {
	font-size: 16px;
	font-weight: bold;
}
.Stil3 {font-size: 24px}


-->
</style>



</head>
<body>
<script src="js/chess.js"></script>
<div id="board" style="width:450px"></div>


<script src="js/json3.min.js"></script>
<script src="js/jquery-1.10.1.min.js"></script>
<script src="js/chessboard.js"></script>
<script src="js/save.js"></script>
<script src="js/restore.js"></script>
<script src="js/figuren.js"></script>
<script src="js/ajaxsbmt.js"></script>
<script src="js/botty.js"></script>

<script>
//debuggen
debug = true; //false
// Variablen definieren
ini = 0;
i=0;
b_zeit = 0;
w_zeit = 0;
weiss ='';
schwarz='';
vergleich_user_nachricht = 0;
pos=0;
remise = 0;
// Variablen definieren Ende
var init = function() {

//--- start example JS ---


var board,
  game = new Chess();
 
 Partie = window.setInterval(makeMove, 1000);
// do not pick up pieces if the game is over
// only pick up pieces for White
var onDragStart = function(source, piece, position, orientation) {

if (game.game_over() === true ||
      (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
      (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false;
  }
};
// Partiezug machen

  function makeMove() {
  // Refresh - Zaeler
  i++;
// Daten holen Anfang
// Die Daten befinden sich in der Varialble content_restore;
//---------------------------------------------------------------------
geholt = function (partie_daten){

if(debug){document.getElementById('partie_daten').innerHTML = partie_daten;}

 var partie_daten = partie_daten.split("##");
 partie_nr = partie_daten[0];
 partie_zug = partie_daten[1];
 w_player = partie_daten[2];
 b_player = partie_daten[3];
 warten_w_player = partie_daten[4];
 w_zeit_player = partie_daten[5];
 b_zeit_player = partie_daten[6];
 wer_zieht = partie_daten[7];
 fen = partie_daten[8];
 nachricht = partie_daten[9];
 user_nachricht = partie_daten[10];

var user  = "<?php  echo $user?>";
 
// Bei eimem Remis Angebot wird ein Fenster aufgemacht


 var regex = /REMIS/i;
if (user_nachricht.match(regex) && remise == 0) {
var n_daten = user_nachricht.split(":");
wer_user = n_daten[3]; 
if (wer_user == w_player || wer_user == b_player) {
if (user == w_player || user == b_player) {
if (user != wer_user){
Check = confirm(wer_user+' bietet Remis');
if (Check == true)  {user_nachricht ="Die Partie endet Unentschieden!"; init(); return;}
if (Check == false) {remise = 1;}
}}}}

 if (!user_nachricht.match(regex)) {remise = 0;}
// Bei eimem Remis Angebot wird ein Fenster aufgemacht 
 
//var nachricht_daten =  user_nachricht.split(":");
//var remis_mitt = nachricht_daten[1];
  // Brett neu starten
 if(nachricht == "INIT" && ini == 0){ init();}
 
 document.getElementById("user_nachricht").innerHTML=user_nachricht; 
 // Brett in die richtige Position bringen
  function position_schwarz() {board.orientation('black');}

 if (b_player == user && pos==0){position_schwarz ();pos=1;} 
 //else {board.orientation('white');}
 // Brett in die richtige Position bringen

//schwarz ();


 //var user_nachricht_daten = user_nachricht.split("::");
// if(user_nachricht != vergleich_user_nachricht){alert(user_nachricht+ vergleich_user_nachricht);  vergleich_user_nachricht = user_nachricht; }
 
 
if (w_player == "0" && b_player == "0" ){nachricht = "Keine Spieler am Brett"; w_zeit = -1; b_zeit =0; }
 
 // Spieler anzeigen
 document.getElementById("w_player").innerHTML =  w_player;
 document.getElementById("b_player").innerHTML =  b_player;
 
 if (w_player != "0" && b_player == "0" ){user_nachricht = w_player+" hat die Partie betreten"; sound(); w_zeit = -1; b_zeit =0; }
 
  // Wenn kein zweiter Spieler gesetzt ist wird die Partie neu gestartet
 //timestamp
var ts = Math.round((new Date()).getTime() / 1000);
var diff_time = ts - warten_w_player;
var diff_time = Number(diff_time);
var wartezeit_auf_gegner = <?php echo $wartezeit_auf_gegner ?>;
var wartezeit_auf_gegner = Number(wartezeit_auf_gegner);
if (w_player != "0" && b_player == "0"  && diff_time  >= wartezeit_auf_gegner){user_nachricht ='Kein zweiter Spieler'; init(); return;}
 
 //Wenn beide Spieler das Brett verlassen haben
var del_partie_zeit = <?php echo $del_partie_zeit ?>;
var del_partie_zeit = Number(del_partie_zeit);

if (w_player != "0" && b_player != "0" && diff_time >= del_partie_zeit){user_nachricht ='Partie ist abgelaufen'; init(); return;}
  document.getElementById("diff_time").innerHTML = diff_time ;
 // nachricht schreiben
 document.getElementById("nachricht").innerHTML = nachricht;
 
 // Brett neu starten
 if(nachricht == "INIT" && ini=="0"){init();}
 
 // Zeit die fuer die Partie
var partie_zeit = "<?php  echo $partie_zeit ?>";
 //Schach uhr
if (wer_zieht=="w"){w_zeit++; b_zeit = 0; w_zeit_player = Number(w_zeit_player) + Number(w_zeit);}
if (wer_zieht=="b"){b_zeit++; w_zeit = 0; b_zeit_player = Number(b_zeit_player) + Number(b_zeit);}

w_rest_zeit = partie_zeit - w_zeit_player;
b_rest_zeit = partie_zeit - b_zeit_player;
// Schach uhr
document.getElementById("w_zeit_player").innerHTML=w_rest_zeit;
document.getElementById("b_zeit_player").innerHTML=b_rest_zeit;
 //Schach uhr
 
// if (w_player == "0" && b_player == "0" ){user_nachricht = "Kein Spieler am Brett"; w_zeit = 0; b_zeit =0; return;}

 
if (wer_zieht=="w" && w_zeit_player >= partie_zeit){user_nachricht ="Weiss verliert durch Zeit"; init(); return;}
if (wer_zieht=="b" && b_zeit_player >= partie_zeit){user_nachricht ="Schwarz verliert durch Zeit"; init(); return;}
if (wer_zieht=="w" && game.in_checkmate() === true){user_nachricht ="Weiss  verliert durch Matt"; init(); return;}
if (wer_zieht=="b" && game.in_checkmate() === true){user_nachricht ="Schwarz verliert durch Matt"; init(); return;}
if (game.in_draw() === true){user_nachricht ="Die Partie endet Unentschieden!"; init(); return;}
  
//Der Zug wird aufgesplittet
var zug = partie_zug.split("-");
zug_von = zug[0];
zug_nach = zug[1];


 var move = game.move({
   from: zug_von,
    to: zug_nach,
    promotion: 'q' // NOTE: always promote to a pawn for example simplicity
	}  );
board.position(fen);


document.getElementById("i").innerHTML=i;
if(debug){document.getElementById("fen").innerHTML=game.fen();}

document.getElementById("pgn").value=game.pgn(); // ins Texfeld schreiben
//fen=game.fen();
geschlagen_figuren(fen);
	// Beim Zug wird ein Ton abgespielt
  if (game.turn() === 'w') {schwarz = 1;}
  else {weiss = 1;}
if (game.turn() === 'w' && weiss == 1) {weiss++; sound();ini = 0;}
 if (game.turn() === 'b' && schwarz == 1) {schwarz++; sound();ini = 0;}

<?php echo $botty ?>
}

setRequest_restore();


};
//---------------------------------------------------------------------
// Daten holen Ende


  
var onDrop = function(source, target) {
var user  = "<?php  echo $user?>";
   if (w_player =="0" || b_player =="0"){nachricht = "Partie hat noch nicht begonnen"; document.getElementById('nachricht').innerHTML = nachricht; return;}
   if (w_player != user && b_player != user){nachricht = "Spieler gehoert nicht Zur Partie"; document.getElementById('nachricht').innerHTML = nachricht; return;}
 if (w_player == user && game.turn() == "b"){nachricht = "Gegner ist am Zug"; document.getElementById('nachricht').innerHTML = nachricht; return;}
 if (b_player == user && game.turn() == "w"){nachricht = "Gegner ist am Zug"; document.getElementById('nachricht').innerHTML = nachricht; return;}
   
  // see if the move is legal
  var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  });

  // illegal move
  if (move === null) return 'snapback';
//Der Schleifenrequest wird unterbrochen
 window.clearInterval(Partie);
 
  // Der Zug wird gespeichert
zug=source+"-"+target;
speichern(zug);

 // Dann zieht der Gegner
 ini = 0;
//Der Schleifenrequest wird neu gestartet
Partie = window.setInterval(makeMove, 1000);


};

// update the board position after the piece snap
// for castling, en passant, pawn promotion
var onSnapEnd = function() {
  board.position(game.fen());


};

var cfg = {
  draggable: true,
  position: 'start',
  onDragStart: onDragStart,
  onDrop: onDrop,
  onSnapEnd: onSnapEnd
};
board = new ChessBoard('board', cfg);
$('#flipOrientationBtn').on('click', board.flip);

//---------------------------------------------------------------------
// Partie aufgeben
var user  = "<?php  echo $user?>";
$('#aufgabe').on('click', function() {

//if (w_player == "0" ||  b_player == "0" ){user_nachricht ="Keine Aufgabe moeglich"; return;}
if (w_player == user ){user_nachricht ="Weiss hat aufgegeben"; init(); return;}
if (b_player == user ){user_nachricht  ="Schwarz hat aufgegeben";  init(); return;}
});
//---------------------------------------------------------------------
// Brett neu starten Anfang
$('#startPositionBtn').on('click', init);

 function init() {
ini=1;
 b_zeit = 0;
 w_zeit = 0;
 pos=0;
 game = new Chess();
 var cfg = {
  draggable: true,
  position: 'start',
  onDragStart: onDragStart,
  onDrop: onDrop,
  onSnapEnd: onSnapEnd
};
board = new ChessBoard('board', cfg);
$('#flipOrientationBtn').on('click', board.flip);


//document.getElementById("fen").innerHTML='';
//document.getElementById("pgn").innerHTML='';
meldungen = "";
w_zeit = 0;
b_zeit = 0;
w_zeit_player = 0;
b_zeit_player = 0;
wartezeit = 0;
w_rest_zeit =0;
b_rest_zeit =0;
nachricht = 'INIT';


  var partie_daten =  '1##0##0##0##0##0##0##w##rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1##'+nachricht+'##'+user_nachricht;
 //hier wird das Paket abgeschickt

gespeichert = function (partie_save){
if(debug){document.getElementById('partie_save').innerHTML = partie_save;}
}
setRequest_save(partie_daten);

return
};
// Brett neu starten Ende
//-----------------------------------------------------------
// Partie speichern Anfang
function speichern(zug) {
turn = game.turn();
document.getElementById("zug").innerHTML=zug;

//timestamp
var ts = Math.round((new Date()).getTime() / 1000);
//Daten aufbereiten
  partie_daten =  partie_nr+'##'+zug+'##'+w_player+'##'+b_player+'##'+ts+'##'+w_zeit_player+'##'+b_zeit_player+'##'+turn+'##'+game.fen()+'##'+zug+'##'+user_nachricht;

 
 
gespeichert = function (partie_save){
if(debug){document.getElementById('partie_save').innerHTML = partie_save;}
} 
 setRequest_save(partie_daten); // gespeichert

}
// Partie speichern Ende
//-----------------------------------------------------------


}; // end init()
$(document).ready(init);

function sound(){
	document.getElementById('sound').innerHTML = '<audio autoplay preload controls> <source src="sound/move.wav" type="audio/wav" /> </audio>';
}


</script>









<div id="box1">
  <table width="100%"  border="0">
    <tr>
      <td colspan="3" align="left"> <div align="left"><span class="Stil3"><span id="w_player">0</span > - <span id="w_zeit_player">000</span> -:- <span id="b_zeit_player">000</span> - <span id="b_player">0</span></span>
      </td>
    </tr>
    <tr>
      <td colspan="3">Board: <span id="nachricht"></span></td>
    </tr>
    <tr>
      <td width="31%" colsp
an="3"></td>    </tr>
    <tr align="left">
      <td><form name="MyForm1" action="" method="post" onsubmit="xmlhttpPost('start.php', 'MyForm1', 'nachricht', '<img src=\'pleasewait.gif\'>'); return false;">
  <input name="send_button" type="submit"  value="Partie betreten" style="width: 150px; height: 25px; font-size:15px; color:#666666;"><input name="player" type="hidden" id="player" value="<?php echo $user; ?>">
      </form></td>
      <td width="31%">&nbsp;</td>
    <td width="39%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><input type="button" style="width: 150px; height: 25px; font-size:15px; color:#666666;" id="aufgabe" value="Partie aufgeben" /></td>
    </tr>
    <tr>
      <td colspan="3"><form name="MyForm3" action="" method="post" onsubmit="xmlhttpPost('nachricht.php', 'MyForm3', 'nachricht', '<img src=\'pleasewait.gif\'>'); return false;">
        <input name="send_button" type="submit"  value="Remis" style="width: 150px; height: 25px; font-size:15px; color:#666666;">
        <input name="user_nachricht" type="hidden" value="Remis"   >
        <input name="player" type="hidden" id="player" value="<?php echo $user; ?>">
    </form></td>
    </tr>
    <tr>
      <td colspan="3"><span class="Stil2">Nachricht: <span id="user_nachricht"></span> </span></td>
    </tr>
    <tr>
      <td colspan="3"><form name="MyForm2" action="" method="post" onsubmit="xmlhttpPost('nachricht.php', 'MyForm2', 'nachricht', '<img src=\'pleasewait.gif\'>'); return false;">
         <p align="left">
          <input name="player" type="hidden" id="player" value="<?php echo $user; ?>">
          <input name="user_nachricht" type="text" class="white-1e1d7" id="user_nachricht" onFocus="this.value=''" size="50" maxlength="100">
          <input name="send_button" type="submit"  value="Nachricht " style="width: 100px; height: 25px; font-size:15px; color:#666666;">
         </p>
         </form></td>
    </tr>
      <td colspan="3">PGN:</td>
    </tr>
    <tr valign="top">
      <td colspan="3">
        <div align="left">
          <textarea name="pgn" cols="50" rows="5" class="white-1e1d7" id="pgn"></textarea>
</div></td>
    </tr>
    <tr>
      <td colspan="3"></td>
    </tr>
  </table>
</div>
<div id="box2">Figuren: <span id="geschlagen_figuren"></span></div>

  <span id="sound"></span><br>
  


B:<div id="botty"></div>
 Gespeichert: <span id="partie_save"></span><br>
 Geholt: <span id="partie_daten"></span><br>
 Fen: <span id="fen"></span><br>
 Refresh: <span id="i"></span>
 diff_time:<span id="diff_time"></span> 
 Zug: <span id="zug"></span>
</body>
</html>