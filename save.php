<?php
#----------------------------------------------------------------------------------------
# Ralf Urban 5.3.2014
#----------------------------------------------------------------------------------------
include "config.php";
$timestamp = time();
$status= "";
$gewinner = "";
$verlierer = "";
$modus = "";
#----------------------------------------------------------------------------------------

if (!isset($_POST['partie'])) {echo "exit"; exit;}
$partie_daten=$_POST['partie'];

if ($partie_daten =="") {echo "exit"; exit;}
#----------------------------------------------------------------------------------------

$teile = explode("##", $partie_daten);
$zug = $teile[1];
$w_player = $teile[2];
$b_player = $teile[3];
$user_nachricht = $teile[10];
if ($partie_daten ==""){exit;}

#----------------------------------------------------------------------------------------
# Ist die Partie zu Ende?
$pos = strpos($user_nachricht, "::gewinnt::");

if ($pos === false) {
    $status ="kein Ergebnis";
} else {

    $status = "gewinnt";
}
#----------------------------------------------------------------------------------------
# Das Ergebnist wird extrahiert
if ($status == "gewinnt"){

$ergebnis = explode("::", $user_nachricht);
$gewinner = $ergebnis[0];
$verlierer = $ergebnis[2];
$modus = $ergebnis[3];
#----------------------------------------------------------------------------------------
# Falls nicht vorhanden werden Userdaten angelegt
#----------------------------------------------------------------------------------------
if (!file_exists("data/spieler/$gewinner.dat")) {

# Die Datei wird angelegt
$anzahl_winnner = 1;
$gewonnen_winnner = 1;
$verloren_winnner = 0;
$remis_winnner = 0;
$elo_winnner = 1500;
$partie_ergebnisse = "$anzahl_winnner##$gewonnen_winnner##$verloren_winnner##$remis_winnner##$elo_winnner##$timestamp";
$datei = fopen("data/spieler/$gewinner.dat", "w");
fwrite($datei, $partie_ergebnisse);
fclose($datei);
}
#----------------------------------------------------------------------------------------
if (!file_exists("data/spieler/$verlierer.dat")) {

# Die Datei wird angelegt
$anzahl_loser = 1;
$gewonnen_loser = 0;
$verloren_loser = 1;
$remis_loser = 0;
$elo_loser = 1500;
$partie_ergebnisse = "$anzahl_loser##$gewonnen_loser##$verloren_loser##$remis_loser##$elo_loser##$timestamp";
$datei = fopen("data/spieler/$verlierer.dat", "w");
fwrite($datei, $partie_ergebnisse);
fclose($datei);
}
#----------------------------------------------------------------------------------------
#Die Ergebnisse werden ausgewertet und modifiziert Gewinner
$datei = fopen("data/spieler/$gewinner.dat", "r");
$daten_winner = fgets($datei, 200);
fclose($datei);

$datei = fopen("data/spieler/$verlierer.dat", "r");
$daten_loser = fgets($datei, 200);
fclose($datei);

$user_ergebnis = explode("##", $daten_winner);
$anzahl_winnner = $user_ergebnis[0];
$gewonnen_winnner = $user_ergebnis[1];
$verloren_winnner = $user_ergebnis[2];
$remis_winnner = $user_ergebnis[3];
$winnerRating = $user_ergebnis[4];
$zeit_speicherung = $user_ergebnis[5];

$user_ergebnis = explode("##", $daten_loser);
$anzahl_loser = $user_ergebnis[0];
$gewonnen_loser = $user_ergebnis[1];
$verloren_loser = $user_ergebnis[2];
$remis_loser = $user_ergebnis[3];
$loserRating = $user_ergebnis[4];
$zeit_speicherung = $user_ergebnis[5];

 // Factors for the winner and loser
            $Factor = ( (double) 3400 - $loserRating ) * ( (double) 3400 - $loserRating ) / 100000.0;

            // Difference of Ratings
            $Diff = $loserRating-$winnerRating;

            // Expectation of Result
            $Exp  = 0.5
                + 0.001 * $Diff * ( 1.4217 - 0.001 * abs($Diff) * ( 0.24336
                    + 0.001 * abs($Diff) * ( 2.514 - abs($Diff) * 0.001991)));
            if ( $Exp > 1 ) $Exp = 1; // Maximal Result is 1
            if ( $Exp < 0 ) $Exp = 0; // Minimal Result is 0

            // Set xpw ( number of won points ) ans xpl ( number of lost points )
            // both are the absolute value!
          $punkte =  floor( ( 0 - $Exp ) * $Factor * (-1) );

$rating_los = $loserRating - $punkte;
$rating_win = $winnerRating + $punkte;

if ($zeit_speicherung +10 < $timestamp){#doppelte und dreifache Speicherung verhindern
$anzahl_winnner = $anzahl_winnner + 1;
$gewonnen_winnner = $gewonnen_winnner + 1;

$ergebnisse = "$anzahl_winnner##$gewonnen_winnner##$verloren_winnner##$remis_winnner##$rating_win##$timestamp";
$datei = fopen("data/spieler/$gewinner.dat", "w");
fwrite($datei, $ergebnisse);
fclose($datei);}
#----------------------------------------------------------------------------------------
#Die Ergebnisse werden ausgewertet und modifiziert Verlierer

if ($zeit_speicherung +10 < $timestamp){
$anzahl_loser = $anzahl_loser + 1;
$verloren_loser = $verloren_loser + 1;
$ergebnisse = "$anzahl_loser##$gewonnen_loser##$verloren_loser##$remis_loser##$rating_los##$timestamp";
$datei = fopen("data/spieler/$verlierer.dat", "w");
fwrite($datei, $ergebnisse);
fclose($datei);}
#sleep(4);
#----------------------------------------------------------------------------------------
#$user_nachricht = "$gewinner hat die Partie gewonnen. Ergebnis wurde gespeichert";
#$partie_daten =  "1##0##0##0##$timestamp##0##0##w##rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1##INIT##$user_nachricht";
#$datei = fopen("data/partie.dat", "w");
#fwrite($datei, $partie_daten);
#fclose($datei);

}

#----------------------------------------------------------------------------------------
#----------------------------------------------------------------------------------------
$datei = fopen("data/partie.dat", "w");
fwrite($datei, $partie_daten);
fclose($datei);

#----------------------------------------------------------------------------------------

header('Content-Type: text/html; charset=utf-8'); // sorgt für die korrekte Kodierung
header('Cache-Control: must-revalidate, pre-check=0, no-store, no-cache, max-age=0, post-check=0'); // ist mal wieder wichtig wegen IE
echo $partie_daten;

?>