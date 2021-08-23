const {MongoClient} = require('mongodb');
const bcryptjs = require("bcryptjs")
module.exports = class MongoHelper {
    constructor(DB_NAME) {
        this.DB_NAME = DB_NAME
        const uri = "mongodb+srv://admin:z4WKKxvDJjZYX4RI@cluster0.3ef2t.mongodb.net/home-automation?retryWrites=true&w=majority";
        this.client = new MongoClient(uri, {useNewUrlParser: true, useUnifiedTopology: true});
    }

    async connect() {
        this.client = await this.client.connect()
    }

    async disconnect() {
        this.client = await this.client.disconnect()
    }

    async getAllUsers() {
        const result = await this.client.db(this.DB_NAME).collection("users").find()
        const results = await result.toArray();
        return JSON.stringify(results);
    }

    async getUser(email) {
        const result = await this.client.db(this.DB_NAME).collection("users").findOne({email})
        return JSON.stringify(result);
    }

    async getAllDevices(email) {
        const result = await this.client.db(this.DB_NAME).collection("devices").find().filter({email})
        const results = await result.toArray();
        return JSON.stringify(results);
    }

    async getDevice(deviceId) {
        const result = await this.client.db(this.DB_NAME).collection("devices").findOne({deviceId})
        return JSON.stringify(result);
    }


    async addUser(email, password) {
        let hashPassword = await bcryptjs.hash(password, 12)
        const user = {
            email,
            password: hashPassword
        }
        const result = await this.client.db(this.DB_NAME).collection("users").insertOne(user)
        return result.insertedId.toString();
    }

    async addDevice(email, deviceId, deviceName) {
        const device = {
            email,
            deviceId,
            deviceName,
            relayStatus: {0: false, 1: false, 2: false, 3: false}
        }
        const result = await this.client.db(this.DB_NAME).collection("devices").insertOne(device)
        return result.insertedId.toString();
    }

    async checkCredentials(email, password) {
        const result = await this.client.db(this.DB_NAME).collection("users").findOne({email})
        const response = await bcryptjs.compare(password, result.password)
        return JSON.stringify({
            result: response
        })
    }

    async updateRelayStatus(deviceId, relayIndex, relayStatus) {
        const key = `relayStatus.${relayIndex}`
        const result = await this.client.db(this.DB_NAME).collection("devices").updateOne(
            {deviceId}, {$set: {[key]: (relayStatus === 'true')}})
        return JSON.stringify(result)

    }
};



