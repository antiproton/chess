<?php
#-------------------------------------------------------------------------
# R. Urban 22.2.2014
#-------------------------------------------------------------------------

$datei = fopen("data/partie.dat", "r");
$partie_daten = fgets($datei, 200);
fclose($datei);


header('Content-Type: text/html; charset=utf-8'); // sorgt für die korrekte Kodierung
header('Cache-Control: must-revalidate, pre-check=0, no-store, no-cache, max-age=0, post-check=0'); // ist mal wieder wichtig wegen IE
echo $partie_daten;
exit;
?>