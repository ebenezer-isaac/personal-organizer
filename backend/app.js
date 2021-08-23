var express = require('express')
var app = express()
const port = 8080
const MongoHelper = require('./mongo.js')
const db = new MongoHelper()
const cors = require('cors');
app.use(cors({
    origin: '*'
}));
db.connect()
app.get('/getAllUsers', function (req, res) {
    db.getAllUsers().then((data) => {
        res.end(data)
    })
});
app.get('/getUser/:email', function (req, res) {
    console.log(req.params["email"])
    db.getUser(req.params["email"]).then((data) => {
        res.end(data)
    })
});
app.get('/getAllDevices/:email', function (req, res) {
    db.getAllDevices(req.params["email"]).then((data) => {
        res.end(data)
    })
});
app.get('/getDevice/:deviceID', function (req, res) {
    db.getDevice(req.params["deviceID"]).then((data) => {
        res.end(data)
    })
});

app.get('/addUser/:email/:password', function (req, res) {
    db.addUser(req.params["email"], req.params["password"]).then((data) => {
        res.end(data)
    })
});
app.get('/addDevice/:email/:deviceID/:deviceName', function (req, res) {
    db.addDevice(req.params["email"],req.params["deviceID"],req.params["deviceName"]).then((data) => {
        res.end(data)
    })
});
app.get('/checkCredentials/:email/:password', function (req, res) {
    db.checkCredentials(req.params["email"], req.params["password"]).then((data) => {
        res.end(data)
    })
});
app.get('/updateRelayStatus/:deviceId/:relayIndex/:relayStatus', function (req, res) {
    db.updateRelayStatus(req.params["deviceId"], req.params["relayIndex"], req.params["relayStatus"]).then((data) => {
        res.end(data)
    })
});




app.listen(port, () => {
    console.log(`Example app listening at http://localhost:${port}`)
})

