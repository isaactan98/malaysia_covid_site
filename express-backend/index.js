const express = require('express')
const app = express()
const port = process.env.PORT || 4000

const { parseCSV } = require('./common.js');

app.get('/', (req, res) => {
    res.send('This is the root path for Malaysia COVID-19 API')
})

app.get('/api/cases', async (req, res) => {
    // res.send('Hello World!')
    const msiacase = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv";
    let result = null;
    await fetch(msiacase)
        .then(res => res.text())
        .then(text => {
            // console.log(text)
            result = parseCSV(text);
        })
        .catch(err => {
            console.log(err)
        })
    res.send(result);
})

app.get('/api/state', async (req, res) => {
    // res.send('Hello World!')
    const msiacase = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_state.csv";
    let result = null;
    await fetch(msiacase)
        .then(res => res.text())
        .then(text => {
            // console.log(text)
            result = parseCSV(text);
        })
        .catch(err => {
            console.log(err)
        })
    res.send(result);
})


app.listen(port, () => {
    console.log(`Example app listening on port ${port}`)
})

