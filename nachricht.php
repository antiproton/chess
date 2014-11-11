<?php
#-----------------------------------------------------------------------------------
# Ralf Urban 26.1.2014
#-----------------------------------------------------------------------------------
#var_dump($_POST);
$player=$_POST['player'];
$user_nachricht=$_POST['user_nachricht'];
$timestamp = time();
$uhrzeit = date("H:i:s",$timestamp);
#-----------------------------------------------------------------------------------

	$such_array  = array ('ä', 'ö', 'ü', 'ß','Ä','Ö','Ü');
	$ersetzen_array = array ('ae', 'oe', 'ue', 'ss','ae', 'oe', 'ue');
	$user_nachricht  = str_replace($such_array, $ersetzen_array, $user_nachricht);
#-----------------------------------------------------------------------------------

$user_nachricht = strip_tags($user_nachricht);
$user_nachricht = "[$uhrzeit] :$player: $user_nachricht";

$user_nachricht = wordwrap($user_nachricht, 50, "<br>", true);
echo  $user_nachricht;
#-----------------------------------------------------------------------------------

$datei = fopen("data/partie.dat", "r");
$partie_daten = fgets($datei, 200);
fclose($datei);
#-----------------------------------------------------------------------------------


$teile = explode("##", $partie_daten);
$partie_nr = $teile[0];
$zug = $teile[1];
$w_player = $teile[2];
$b_player = $teile[3];
$warten_w_player = $teile[4];
$w_zeit_player = $teile[5];
$b_zeit_player = $teile[6];
$wer_zieht = $teile[7];
$fen = $teile[8];
$nachricht = $teile[9];


$partie_daten = "$partie_nr##$zug##$w_player##$b_player##$warten_w_player##$w_zeit_player##$b_zeit_player##$wer_zieht##$fen##$nachricht##$user_nachricht";

$datei = fopen("data/partie.dat", "w");
fwrite($datei, $partie_daten);
fclose($datei);

?>