<!--
	var request = false;

	// Request senden
	function setRequest_save(value) {
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

		// �berpr�fen, ob Request erzeugt wurde
		if (!request) {
			alert("Kann keine XMLHTTP-Instanz erzeugen");
			return false;
		} else {
			var url = "save.php";
			// Request �ffnen
			request.open('post', url, true);
			// Requestheader senden
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			// Request senden
			request.send('partie='+value);
			// Request auswerten
			request.onreadystatechange = interpretRequest_save;
		}
	}

	// Request auswerten
	function interpretRequest_save() {
		switch (request.readyState) {
			// wenn der readyState 4 und der request.status 200 ist, dann ist alles korrekt gelaufen
			case 4:
				if (request.status != 200) {
					//alert("Der Request wurde abgeschlossen, ist aber nicht OK\nFehler:"+request.status);
				} else {
					 partie_save = request.responseText;

					 gespeichert (partie_save);
					//document.getElementById('content_save').innerHTML = content_save;

					// return content_save;

					// den Inhalt des Requests in das <div> schreiben

				}


				break;
			default:
				break;


		}


	}





  //-->