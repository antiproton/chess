<?php
##############################################################################################
#                                                                                            #
#                                                                                            #
# *                            -------------------                                           #
# *   begin                : 15.2.2014                                                       #
# *   copyright            : dr.urban@netreal.de                                             #
# *   VERSION:             : 1                                                               #
#                                                                                            #
##############################################################################################
#    This program is free software; you can redistribute it and/or modify it under the       #
#    terms of the GNU General Public License as published by the Free Software Foundation;   #
#    either version 2 of the License, or (at your option) any later version.                 #
#                                                                                            #
#    This program is distributed in the hope that it will be useful, but                     #
#    WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS   #
#    FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.          #
#                                                                                            #                                             #
#                                                                                            #
##############################################################################################
$timestamp = time();
#--------------------------------------------------------------------------------------------------
include "../config.php";

  $engine_name = "engine";                    /* at Linux */
# $engine_name = "engine.exe";             /* at Windows */

#---------------------------------------------------------------------------------------------
$zufall = rand(1,100);

#$name ="GUEST$zufall"; #Name des Bots

$name ="Huhn"; #Name des Bots
#---------------------------------------------------------------------------------------------
# Daten werden geholt

$datei = fopen("$bot_path/data/partie.dat", "r");
$partie_daten = fgets($datei, 200);
fclose($datei);

$teile = explode("##", $partie_daten);

$partie_nr = $teile[0];
$zug = $teile[1];
$w_player = $teile[2];
$b_player = $teile[3];
$warten_w_player = $teile[4];
$w_zeit_player = $teile[5];
$b_zeit_player = $teile[6];
$wer_zieht = $teile[7];
$fen_brett = $teile[8];
$nachricht = $teile[9];


#---------------------------------------------------------------------------------------------

if ($w_player =="0" && $b_player == "0"){echo "Brett ist leer";exit;}
#if ($wer_zieht =="w"){echo "nicht am Zug"; exit;}
#---------------------------------------------------------------------------------------------
# Wenn der erste Spieler kommt wird Botty inetialisiert.
# Jetzt wird der Bot vorbereitet er braucht Futter
# Für Schachbot Initaldatei lesen
if ($w_player !="0" && $b_player == "0"){

sleep(2);



$datei = fopen("initBoard.txt","r+");
$fen = fgets($datei, 100);
fclose($datei);

$fen = str_replace("@move", "05@move", $fen);

$datei = fopen("board.txt","w+");
rewind($datei);
fwrite($datei, $fen);
fclose($datei);


$datei = fopen("boardIn.txt","w+");
rewind($datei);
fwrite($datei, $fen);
fclose($datei);
# dann wird der zweite Spieler gesetzt

$partie_daten =  "1##0##$w_player##$name##$timestamp##0##0##w##$fen_brett##$name betritt das Brett##-";
$datei = fopen("$bot_path/data/partie.dat", "w");
fwrite($datei, $partie_daten);
fclose($datei);

echo "Botty init";exit;
}



#echo "Zug: $zug wer zieht:$wer_zieht<br>";
if ($wer_zieht =="w"){echo "weiss zieht"; exit;}
#---------------------------------------------------------------------------------------------
else{

$datei = fopen("board.txt","r+");
$fen = fgets($datei, 100);
fclose($datei);

 $zug = str_replace("-", "", $zug);

$fen = str_replace("@move", "0$zug", $fen);

$datei = fopen("boardIn.txt","w+");
rewind($datei);
fwrite($datei, $fen);
fclose($datei);


#echo "Botty zieht";

$now = date("d/m/Y H:i:s");
//Move check:
	    $move="";
        $timeS = time();

//invoke the engine
            	  $out = `$bot_path/bot/$engine_name`;
            	  //read the move
                  $fp = fopen("move.txt","r");
                  $move = fread($fp,filesize("move.txt"));
                  fclose($fp);

            $timeT = round((time()-$timeS)/60,2);
           echo "moved: $move Time: $timeT min.<br>";





$t1 = substr($move, -4,2);
$t2 = substr($move, -2);
$move=$t1."-".$t2;
#echo $move;

#---------------------------------------------------------------------------------------------
# Aufbereitung Fen
$datei = fopen("board.txt","r+");
$fen = fgets($datei, 100);
fclose($datei);


$fen_neu ="";
#$fen =  "050d2d40RNBQKBNRPPPP.PPP............P............p......p.pppppprnbqkbnr";
#$fen =  "050g7h70.....RK...P...P...PB...PP..P.......pP..ppp..p....bpknRQ..r..r...";
$fen = substr($fen, 8);
#echo $fen."<br>";

$fenarr = str_split($fen, 1);

#print_r($arr);
for($i=0; $i <= 63; $i++) {
$reihe = "";
if ($i == 8){ $reihe = "/";}
 if ($i == 16){ $reihe = "/";}
 if ($i == 24){ $reihe = "/";}
 if ($i == 32){ $reihe = "/";}
 if ($i == 40){ $reihe = "/";}
 if ($i == 48){ $reihe = "/";}
 if ($i == 56){ $reihe = "/";}
$fen_neu = $fen_neu.$reihe.$fenarr[$i];
}
#-----------------------------------------------------------------------
$fen_fertig="";
$z=0;
$fenarr = str_split($fen_neu, 1);
for($i=0; $i <= 70; $i++) {
$frei="";
if ($fenarr[$i] == "."){$z++;} else {$z=0;}
$fenarr[71]="";
if ($z != "0" && $fenarr[$i+1] != "."){$frei = $z;}
if ($fenarr[$i] == "."){$fenarr[$i] = "";}
$fen_fertig .= $frei.$fenarr[$i];

}

$fen_fertig =  strrev($fen_fertig);
#echo $fen_fertig."<br>";

$reihe = explode("/", $fen_fertig);
$a =  strrev($reihe[0]);
$b =  strrev($reihe[1]);
$c =  strrev($reihe[2]);
$d =  strrev($reihe[3]);
$e =  strrev($reihe[4]);
$f =  strrev($reihe[5]);
$g =  strrev($reihe[6]);
$h =  strrev($reihe[7]);


$fen_fertig = $a."/".$b."/".$c."/".$d."/".$e."/".$f."/".$g."/".$h;

$fen_brett = $fen_fertig." w";
#echo $fen_brett;
#---------------------------------------------------------------------------------------------

#Partie speichern
$b_zeit_player = $b_zeit_player +3;

$partie_daten =  "1##$move##$w_player##$b_player##$timestamp##$w_zeit_player##$b_zeit_player##w##$fen_brett##$move##tt";

$datei = fopen("$bot_path/data/partie.dat", "w");
fwrite($datei, $partie_daten);
fclose($datei);


unlink("$bot_path/bot/move.txt");
unlink("$bot_path/bot/boardIn.txt");

exit;
}
?>