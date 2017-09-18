var speech = new webkitSpeechRecognition();
speech.language = 'en-US';
speech.continuous = true;
speech.interimResults = true;
speech.onresult = function( e ) {
	if ( e.results[e.results.length-1].isFinal){
		var said = e.results[e.results.length-1][0].transcript.toLowerCase();
		console.log(said);
		var sanitized_said = said.trim().replace(/ /g,'')
		document.activeElement.value = sanitized_said;
	
		if(document.activeElement == document.getElementById('Subject')){
			document.getElementById('stYY').focus();
			//document.getElementById("audio2").click(); //voice hints
		}else if(document.activeElement == document.getElementById('stYY')){
			document.getElementById('stMM').focus();
			//voice hints
		}else if(document.activeElement == document.getElementById('stMM')){
			document.getElementById('stDD').focus();
			//document.getElementById("audio3").click(); //voice hints
		}else if(document.activeElement == document.getElementById('stDD')){
			document.getElementById('stHour').focus();
			//document.getElementById("audio4").click(); //voice hints
		}else if(document.activeElement == document.getElementById('stHour')){
			document.getElementById('stMin').focus();
			//voice hints
		}else if(document.activeElement == document.getElementById('stMin')){
			document.getElementById('etYY').focus();
			//voice hints
		}else if(document.activeElement == document.getElementById('etYY')){
			document.getElementById('etMM').focus();
			//voice hints
		}else if(document.activeElement == document.getElementById('etMM')){
			document.getElementById('etDD').focus();
			//document.getElementById("audio3").click(); //voice hints
		}else if(document.activeElement == document.getElementById('etDD')){
			document.getElementById('etHour').focus();
			//document.getElementById("audio4").click(); //voice hints
		}else if(document.activeElement == document.getElementById('etHour')){
			document.getElementById('etMin').focus();
			//voice hints
		}else if(document.activeElement == document.getElementById('etMin')){
			document.getElementById('Location').focus();
			//voice hints
		}else if(document.activeElement == document.getElementById('Location')){
			document.getElementById('Description').focus();
			//voice hints
		}else if(document.activeElement == document.getElementById('Description')){
			document.getElementById('Savebtn').click();
		}
	}
};


speech.start();