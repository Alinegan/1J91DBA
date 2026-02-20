const fs = require("fs");
const path = require("path");

exports.handler = async (event) => {

    if (event.httpMethod !== "POST") {
        return { statusCode: 405, body: "POST only" };
    }

    try {
        // Save JSON to temp (resets sometimes)
        fs.writeFileSync("/tmp/RoomData.json", event.body);

        return {
            statusCode: 200,
            body: "Saved"
        };

    } catch (err) {
        return { statusCode: 500, body: err.toString() };
    }
};
