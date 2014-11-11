<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Statistik</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style></head>
<body>




<?php
$handle=opendir ("data/spieler/");

while ($datei = readdir ($handle)) {

 $pos = strpos($datei, ".dat");
if ($pos == true) {
$user = str_replace(".dat", "", $datei);


 $pos2 = strpos($datei, "GUEST");
#echo $pos2; 

if ($pos2 !== false) {

unlink("data/spieler/$datei");
}

else{


$datei = fopen("data/spieler/$datei", "r");
$daten = fgets($datei, 200);
fclose($datei);


$user_ergebnis = explode("##", $daten);
$anzahl = $user_ergebnis[0];
$gewonnen = $user_ergebnis[1];
$verloren = $user_ergebnis[2];
$remis = $user_ergebnis[3];
$elo = $user_ergebnis[4];
$zeit= $user_ergebnis[5];
$datum = date("d.m.Y",$zeit);
$uhrzeit = date("H:i",$zeit);


echo <<<eof
<hr>
User: $user<br>
Anzahl der Spiele: $anzahl<br>
Gewonnen: $gewonnen<br>
Verloren: $verloren<br>
Elo: $elo<br>
Gesehen: $datum::$uhrzeit

<hr>
eof;


}}


}

closedir($handle);




?>

</body>
</html>