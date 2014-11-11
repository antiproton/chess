function geschlagen_figuren(fen){

//var fen ="/8/8/8/8/PPPPPPPP/NKN w KQkq - 0 ";

//weisse Bauern
var new_fen = fen.split(" ");
 var new_fen = new_fen[0];

var g_w_bauer="";
var regex = /P/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 7-treffer.length;
  }

else {ge_figur = 7;}

 var top_position_w_bauer = 10;
 var left_position_w_bauer = 170;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*15;
	var px = left_position_w_bauer+verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_w_bauer+'px;"><img src="img/chesspieces/wikipedia/wP.png" width="40" height="40"></div>'
	var g_w_bauer = g_w_bauer + figur;

	}
//schwarze Bauern
var g_b_bauer="";
var regex = /p/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 7-treffer.length;
  }

else {ge_figur = 7;}

 var top_position_b_bauer = 50;
 var left_position_b_bauer = 170;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*15;
	var px = left_position_b_bauer+verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_b_bauer+'px;"><img src="img/chesspieces/wikipedia/bP.png" width="40" height="40"></div>'
	var g_b_bauer = g_b_bauer + figur;

	}
//weisse Dame
var g_w_q="";
var regex = /Q/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 0-treffer.length;
  }

else {ge_figur = 0;}

 var top_position_w_q = 10;
 var left_position_w_q = 145;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*15;
	var px = left_position_w_q+verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_w_q+'px;"><img src="img/chesspieces/wikipedia/wQ.png" width="40" height="40"></div>'
	var g_w_q = g_w_q + figur;

	}
//schwarze Dame
var g_b_q="";
var regex = /q/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 0-treffer.length;
  }

else {ge_figur = 0;}

 var top_position_b_q = 50;
 var left_position_b_q = 145;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*15;
	var px = left_position_b_q+verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_b_q+'px;"><img src="img/chesspieces/wikipedia/bQ.png" width="40" height="40"></div>'
	var g_b_q = g_b_q + figur;

	}
//schwarze Turm
var g_b_t="";
var regex = /r/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 1-treffer.length;
  }

else {ge_figur = 1;}

 var top_position_b_t = 50;
 var left_position_b_t = 115;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*20;
	var px = left_position_b_t-verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_b_t+'px;"><img src="img/chesspieces/wikipedia/bR.png" width="40" height="40"></div>'
	var g_b_t = g_b_t + figur;

	}
//weisser Turm
var g_w_t="";
var regex = /R/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 1-treffer.length;
  }

else {ge_figur = 1;}

 var top_position_w_t = 10;
 var left_position_w_t = 115;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*20;
	var px = left_position_w_t-verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_w_t+'px;"><img src="img/chesspieces/wikipedia/wR.png" width="40" height="40"></div>'
	var g_w_t = g_w_t + figur;

	}
//weisser Springer
var g_w_n="";
var regex = /N/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 1-treffer.length;
  }

else {ge_figur = 1;}

 var top_position_w_n = 10;
 var left_position_w_n = 65;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*20;
	var px = left_position_w_n-verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_w_n+'px;"><img src="img/chesspieces/wikipedia/wN.png" width="40" height="40"></div>'
	var g_w_n = g_w_n + figur;

	}
//schwarzer Springer
var g_b_n="";
var regex = /n/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 1-treffer.length;
  }

else {ge_figur = 1;}

 var top_position_b_n = 50;
 var left_position_b_n = 65;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*20;
	var px = left_position_b_n-verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_b_n+'px;"><img src="img/chesspieces/wikipedia/bN.png" width="40" height="40"></div>'
	var g_b_n = g_b_n + figur;

	}
//schwarzer Leufer
var g_b_b="";
var regex = /b/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 1-treffer.length;

  }

else {ge_figur = 1;}

 var top_position_b_b = 50;
 var left_position_b_b = 20;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*20;
	var px = left_position_b_b-verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_b_b+'px;"><img src="img/chesspieces/wikipedia/bB.png" width="40" height="40"></div>'
	var g_b_b = g_b_b + figur;

	}

	//document.getElementById("geschlagen_figuren").innerHTML=g_b_bauer+g_w_bauer+g_w_q+g_b_q+g_b_t+g_w_t+g_w_n+g_b_n+g_b_b;
//weisser Leufer
var g_w_b="";
var regex = /B/g;
if (new_fen.match(regex)) {
    var treffer = new_fen .match(regex);

 var ge_figur = 1-treffer.length;
  }

else {ge_figur = 1;}

 var top_position_w_b = 10;
 var left_position_w_b = 20;

	for (var a = 0; a <= ge_figur; a++){
var verschiebung = a*20;
	var px = left_position_w_b-verschiebung;
	var figur = '<div  style=" position: absolute;left:'+ px +'px; top:'+top_position_w_b+'px;"><img src="img/chesspieces/wikipedia/wB.png" width="40" height="40"></div>'
	var g_w_b = g_w_b + figur;

	}

	document.getElementById("geschlagen_figuren").innerHTML=g_b_bauer+g_w_bauer+g_w_q+g_b_q+g_b_t+g_w_t+g_w_n+g_b_n+g_b_b+g_w_b;

	//document.getElementById("geschlagen_figuren").innerHTML=new_new_fen;

return;
}