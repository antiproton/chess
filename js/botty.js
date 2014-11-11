var request = false;

	// Request senden
	function setRequest_botty() {
		// Request erzeugen
		if (window.XMLHttpRequest) {
			request = new XMLHttpRequest(); // Mozilla, Safari, Opera
		} else if (window.ActiveXObject) {
			try {
				request = new ActiveXObject('Msxml2.XMLHTTP'); // IE 5
			} catch (e) {
				try {
					request = new ActiveXObject('Microsoft.XMLHTTP'); // IE 6
				} catch (e) {}
			}
		}

		// überprüfen, ob Request erzeugt wurde
		if (!request) {
			alert("Kann keine XMLHTTP-Instanz erzeugen");
			return false;
		} else {
			var url = "bot/play.php";
			// Request öffnen
			request.open('post', url, true);
			// Request senden
			request.send(null);
			// Request auswerten
			request.onreadystatechange = interpretRequest_botty;
		}
	}

	// Request auswerten
	function interpretRequest_botty() {
		switch (request.readyState) {
			// wenn der readyState 4 und der request.status 200 ist, dann ist alles korrekt gelaufen
			case 4:
				if (request.status != 200) {
					//alert("Der Request wurde abgeschlossen, ist aber nicht OK\nFehler:"+request.status);
				} else {
					var botty = request.responseText;
					// den Inhalt des Requests in das <div> schreiben
					document.getElementById('botty').innerHTML = botty;
				}
				break;
			default:
				break;
		}
	}