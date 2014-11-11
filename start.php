<?php
#var_dump($_POST);
#-----------------------------------------------------------------------------------
# Ralf Urban 8.1.2014
#-----------------------------------------------------------------------------------

include "config.php";

$player = $_POST['player'];
$timestamp = time();

#-----------------------------------------------------------------------------------
#Daten holen

#partienummer##zug##weißer spieler##schwarzer spieler##time warten 1 Spieler##zeitweiß##zeitschwarz##werzieht##fen

$datei = fopen("data/partie.dat", "r");
$partie_daten = fgets($datei, 200);
fclose($datei);

$daten = explode("##", $partie_daten);

$partie_nr = $daten[0];
$partie_zug = $daten[1];
$w_player = $daten[2];
$b_player = $daten[3];
$start_partie = $daten[4];
$w_zeit_player = $daten[5];
$b_zeit_player = $daten[6];
$wer_zieht = $daten[7];
$fen = "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1";

if ($w_player != "0" && $b_player !="0"){$b_player = $player; echo "Die Partie hat schon begonnen.";exit;}
if ($w_player =="0" && $b_player =="0"){$w_player = $player; save("$partie_nr##$partie_zug##$w_player##$b_player##$timestamp##$w_zeit_player##$b_zeit_player##$wer_zieht##$fen##Erster Spieler gesetzt##-");echo "Erster Spieler gesetzt."; exit;}
if ($w_player =="$player" && $b_player =="0"){echo "Mann kann nicht gegen sich selbst spielen!";exit;}
if ($w_player != "0" && $b_player =="0"){$b_player = $player; save("$partie_nr##$partie_zug##$w_player##$b_player##$timestamp##$w_zeit_player##$b_zeit_player##$wer_zieht##$fen##Zweiter Spieler gesetzt##-");echo "Zweiter Spieler gesetzt.";exit;}



function save($partie_daten){
$datei = fopen("data/partie.dat", "w");
fwrite($datei, $partie_daten);
fclose($datei);
}



echo "$partie_daten";


echo $player;
?>