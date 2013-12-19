<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>keypress demo</title>
<style>
fieldset {
margin-bottom: 1em;
}
input {
display: block;
margin-bottom: .25em;
}
#print-output {
width: 100%;
}
.print-output-line {
white-space: pre;
padding: 5px;
font-family: monaco, monospace;
font-size: .7em;
}
</style>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<form>
<fieldset>
<label for="target">Type Something:</label>
<input id="target" type="text">
<input id="target11" type="text">
</fieldset>
</form>
<button id="other">
Trigger the handler
</button>
<script src="http://api.jquery.com/resources/events.js"></script>
<script>
$(document).ready(function () {
	var e = $.Event("keypress");
	e.which = 0; // # Some key code value
	e.keyCode = 9;
	$("#target").trigger(e);
});

$( "#target" ).keypress(function( event ) {
	alert(event.keyCode);
});
</script>
</body>
</html>