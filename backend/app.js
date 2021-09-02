const express = require('express')
const cookieSession = require('cookie-session')
const bodyParser = require('body-parser');
const cors = require('cors');
const MongoHelper = require('./mongo.js')
const port = 8080
const app = express();
const db = new MongoHelper("expenses")
app.use(cors({
    origin: '*'
}));
db.connect().then()
app.use(bodyParser.json());
app.use(cookieSession({
    name: 'session',
    keys: ["ebenezer"],
    httpOnly: false,
    maxAge: 48 * 60 * 60 * 1000 // 48 hours
}))
// app.get('/login', function (req, res) {
//     db.login(req.query.email, req.query.password).then((data) => {
//         res.end(data)
//     })
// });
app.post('/retrieve', function (req, res) {
    console.log("Session", req.session.user_id)
    if (req.session.user_id) {
        console.log("inside if for retrieve")
        db.retrieve(req.session.user_id)
            .then((data) => {
                res.end(data)
            })
    } else {
        res.end(JSON.stringify({result: false}))
    }

});

app.post('/login', function (req, res) {
    db.login(req.body.email.toString().trim(), req.body.password.toString().trim())
        .then((data) => {
            req.session.user_id = data.id.toString()
            res.end(JSON.stringify(data))
        })
});

app.post('/addAccount', function (req, res) {
    let user_id = req.session.user_id
    db.addAccount(user_id, req.body.title.toString().trim(), req.body.balance.toString().trim(), req.body.description.toString().trim())
        .then((data) => {
            res.end(data)
        })
});

app.post('/newTransaction', function (req, res) {
    db.newTransaction(req.body).then((data) => {
        res.end(data)
    })
});
app.post('/getAllTransactions/', function (req, res) {
    console.log("inside transactions",req.body.accounts)
    db.getAllTransactions(req.body.accounts).then((data) => {
        res.end(data)
    })
});
// app.get('/getDevice/:deviceID', function (req, res) {
//     db.getDevice(req.params["deviceID"]).then((data) => {
//         res.end(data)
//     })
// });
//
// app.get('/addUser/:email/:password', function (req, res) {
//     db.addUser(req.params["email"], req.params["password"]).then((data) => {
//         res.end(data)
//     })
// });
// app.get('/addDevice/:email/:deviceID/:deviceName', function (req, res) {
//     db.addDevice(req.params["email"],req.params["deviceID"],req.params["deviceName"]).then((data) => {
//         res.end(data)
//     })
// });
// app.get('/checkCredentials/:email/:password', function (req, res) {
//     db.checkCredentials(req.params["email"], req.params["password"]).then((data) => {
//         res.end(data)
//     })
// });
// app.get('/updateRelayStatus/:deviceId/:relayIndex/:relayStatus', function (req, res) {
//     db.updateRelayStatus(req.params["deviceId"], req.params["relayIndex"], req.params["relayStatus"]).then((data) => {
//         res.end(data)
//     })
// });


app.listen(port, () => {
    console.log(`Example app listening at http://localhost:${port}`)
})

