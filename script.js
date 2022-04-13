const express = require('express');

const app = express();

const path = require('path');

app.listen(2406, () => {
    console.log('server is running....');
})

app.get('/', (req, res) => {
    res.send('Hi');
})

app.get('/webhook.php',callName);

function callName( req, res ) {

	var spawn = require('child_process').spawn;

	var process = spawn('php',["./webhook.php"]);

	process.stdout.on('data',function(data){
		console.log('data received from PHP Script ::' + data.toString());
		res.send(data.toString());
	});

}