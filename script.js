const express = require('express');

const app = express();

const path = require('path');

app.listen(2406, () => {
    console.log('server is running....');
})

app.get('/', (req, res) => {
    res.send('Hi');
})