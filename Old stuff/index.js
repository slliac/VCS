
var colors = { 
    logout:  'logout', 
	lockout: 'lockout',
    listen:         'listen',
    create: 'create',
    orange:     'bittersweet',
    mint:       'mint',
    darkgreen:  'mint',
    sunflower:  'sunflower',
    yellow:     'sunflower',
    grass:      'grass',
    green:      'grass',
    aqua:       'acqua',
    blue:       'acqua',
    bluejeans:  'blue-jeans',
    darkblue:   'blue-jeans',
    lavender:   'lavender_',
    violet:     'lavender_',
    pinkrose:   'pink-rose',
    pink:       'pink-rose',
    lightgrey:  'light-gray',
    darkgrey:   'dark-gray',
    mediumgrey: 'medium-gray',
};
var keys = Object.keys( colors );
var speech = new webkitSpeechRecognition();
speech.language = 'en-US';
speech.continuous = true;
speech.interimResults = true;
speech.onresult = function( e ) {
    if ( e.results[e.results.length-1].isFinal) {
      var said = e.results[e.results.length-1][0].transcript.toLowerCase();
      output.textContent = said;
      
        //for (var i = keys.length - 1; i >= 0; i--) {
            var sanitized_said = said.trim().replace( ' ', '' );

            if ( sanitized_said === 'speak' ) {
                //login.html
				document.getElementById("speak").click();
                //window.location.href = 'login.html'//'http://www.google.com';
            } else if ( sanitized_said === 'lockout' || sanitized_said === 'logout' ) {
                window.location.href = 'login.html';//Please insert the logout function before this statement
            } else if ( sanitized_said === 'insert'|| sanitized_said === 'new') {
				(function(e) {
                var url ="edit.php";
                OpenModelWindow(url,{ width: 500, height: 400, caption: "Create New Calendar"});
            });
				//document.getElementByClass("bubble-sprite").click();
				//window.Edit(data);
				//document.getElementById().click();
			}
        //};
    };
}

speech.start();