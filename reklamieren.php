<?php
#----------------------------------------------------------------------------------------
# Ralf Urban 5.3.2014
#----------------------------------------------------------------------------------------
include "config.php";
$timestamp = time();
#----------------------------------------------------------------------------------------

if (!isset($_POST['player'])) {echo "exit"; exit;}
$player=$_POST['player'];
#----------------------------------------------------------------------------------------
#Daten holen
$datei = fopen("data/partie.dat", "r");
$partie_daten = fgets($datei, 200);
fclose($datei);
#----------------------------------------------------------------------------------------
$user_nachricht="";
$teile = explode("##", $partie_daten);
$zug = $teile[1];
$w_player = $teile[2];
$b_player = $teile[3];
$wer_zieht = $teile[7];
$time_letzter_zug = $teile[4];

if($w_player =="0" || $b_player =="0"){echo "NO";exit;}
if($w_player != $player && $b_player !=$player){echo "Du spielst nicht.";exit;}


$diff_time = $timestamp - $time_letzter_zug;

if ($diff_time < $reklamation_zeit){echo "Letzter Zug vor: $diff_time sec. Limit ist: $reklamation_zeit sec."; exit;}
if ($wer_zieht == "b" ){$user_nachricht = "$w_player::gewinnt::$b_player::Reklamation kein Zug $diff_time sec.";}
if ($wer_zieht == "w" ){$user_nachricht = "$b_player::gewinnt::$w_player::Reklamation kein Zug $diff_time sec.";}

#----------------------------------------------------------------------------------------

$partie_daten =  "1##0##0##egon##$timestamp##0##0##w##rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1##INIT##$user_nachricht";
$datei = fopen("data/partie.dat", "w");
fwrite($datei, $partie_daten);
fclose($datei);


echo $user_nachricht;

?>