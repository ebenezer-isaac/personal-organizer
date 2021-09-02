const {MongoClient} = require('mongodb');
const bcryptjs = require("bcryptjs")
const jwt = require("jsonwebtoken")
module.exports = class MongoHelper {
    constructor(DB_NAME) {
        this.DB_NAME = DB_NAME
        const uri = `mongodb+srv://expense_mgr:wTfEg55rvJc5zDvZ@cluster0.qf8ov.mongodb.net/${DB_NAME}?retryWrites=true&w=majority`;
        this.client = new MongoClient(uri, {useNewUrlParser: true, useUnifiedTopology: true});
    }

    async connect() {
        this.client = await this.client.connect()
    }

    async disconnect() {
        this.client = await this.client.disconnect()
    }

    async login(email, password) {
        const result = await this.client.db(this.DB_NAME).collection("users").findOne({email}, {
            projection: {
                email: false,
                phone: false
            }
        })
        const response = {result: result ? await bcryptjs.compare(password, result.password) : false}
        if (response.result === true) {
            response.id = result._id
            response.token = jwt.sign({id: response.id}, "expense-management", {expiresIn: 600});
            response.name = result.name
            response.accounts = await this.getAccountList(result._id.toString());
        }
        return response
    }

    async getAccountList(owner) {
        const result = await this.client.db(this.DB_NAME).collection("accounts").find({owner})
        return await result.toArray();
    }

    async getTransactions(account, text, type) {

    }

    async addAccount(owner, title, balance, description) {
        const account = {title, balance, description, owner}
        const result = await this.client.db(this.DB_NAME).collection("accounts").insertOne(account)
        let response = {id: result.insertedId.toString(), title, balance, description}
        return JSON.stringify(response)
    }

    async retrieve(id) {
        console.log(id)
        const result = await this.client.db(this.DB_NAME).collection("users").findOne({_id: id}, {
            projection: {
                email: false,
                phone: false
            }
        })
        console.log(result)
        const response = {
            result: true,
            id,
            token: jwt.sign({id}, "expense-management", {expiresIn: 600}),
            name: result.name,
            accounts: await this.getAccountList(result._id.toString())
        }
        return JSON.stringify(response)
    }

    async newTransaction(transaction) {
        const result = await this.client.db(this.DB_NAME).collection("transactions").insertOne(transaction)
        let response = {id: result.insertedId.toString()}
        let difference = transaction.type === "credit" ? +Number(transaction.amount) : -Number(transaction.amount)
        await this.updateBalance(transaction.account, difference)
        return JSON.stringify(response)
    }

    async getAllTransactions(accounts) {
        console.log(accounts)
        let filter_variable = {"account": {"$in": accounts}}
        console.log(JSON.stringify(filter_variable))
        const result = await this.client.db(this.DB_NAME).collection("transactions").find()
            .filter(filter_variable).sort({"time": -1, "account": 1})
        const results = await result.toArray();
        let response = JSON.stringify(results)
        console.log(response)
        return response
    }

    async updateBalance(account, difference) {
        console.log(account, difference)
        const result = await this.client.db(this.DB_NAME).collection("devices").updateOne(
            {account}, {"$inc": {"balance": difference}});
        console.log(JSON.stringify(result))
        return JSON.stringify(result)
    }

    //
    // async addUser(email, password) {
    //     let hashPassword = await bcryptjs.hash(password, 12)
    //     const user = {
    //         email,
    //         password: hashPassword
    //     }
    //     const result = await this.client.db(this.DB_NAME).collection("users").insertOne(user)
    //     return result.insertedId.toString();
    // }
    //
    // async addDevice(email, deviceId, deviceName) {
    //     const device = {
    //         email,
    //         deviceId,
    //         deviceName,
    //         relayStatus: {0: false, 1: false, 2: false, 3: false}
    //     }
    //     const result = await this.client.db(this.DB_NAME).collection("devices").insertOne(device)
    //     return result.insertedId.toString();
    // }
    //

    //
    // async updateRelayStatus(deviceId, relayIndex, relayStatus) {
    //     const key = `relayStatus.${relayIndex}`
    //     const result = await this.client.db(this.DB_NAME).collection("devices").updateOne(
    //         {deviceId}, {$set: {[key]: (relayStatus === 'true')}})
    //     return JSON.stringify(result)
    //
    // }
};



