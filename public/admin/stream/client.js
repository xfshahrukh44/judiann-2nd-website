/*fetch(location.pathname, {method: "POST"})
    .then(res => {
        console.log('sdsd')
        return res.json();
    })
    .then(res => {
        console.log(res)
        const apiKey = res.apiKey;
        const sessionId = res.sessionId;
        const token = res.token;
        const streamName = res.streamName;
        initializeSession(apiKey, sessionId, token, streamName);
    })
    .catch(handleCallback);*/

// initializeSession('47561291', '1_MX40NzU2MTI5MX5-MTY2MjU3MTg2NTk5MH5PQnlRcndVYTNicDFSRldTZEtKL1hOSU5-fg', 'T1==cGFydG5lcl9pZD00NzU2MTI5MSZzaWc9YTIxNzQ1ZTEwMjE0M2IwNDdlZDAwZDQ0MjY1ODk0NzI1NDg5NGZkZTpzZXNzaW9uX2lkPTFfTVg0ME56VTJNVEk1TVg1LU1UWTJNalUzTVRnMk5UazVNSDVQUW5sUmNuZFZZVE5pY0RGU1JsZFRaRXRLTDFoT1NVNS1mZyZjcmVhdGVfdGltZT0xNjYyNTcxODgwJm5vbmNlPTAuMTE0OTMwOTU1MjY3NTQxMjcmcm9sZT1wdWJsaXNoZXImZXhwaXJlX3RpbWU9MTY2NTE2Mzc4MyZpbml0aWFsX2xheW91dF9jbGFzc19saXN0PQ==', 'test');
let session, publisher;

function init(apiKey, sessionId) {
    // Create a session object with the sessionId
    session = OT.initSession(apiKey, sessionId)

    // Create a publisher
    publisher = OT.initPublisher("publisher", {
        insertMode: "replace",
        width: "100%",
        height: "100%",
        name: 'test'
    }, handleCallback);

    // Subscribe to a newly created stream
    session.on("streamCreated", event => {
        session.subscribe(
            event.stream,
            "subscriber",
            {
                insertMode: "append",
                width: "100%",
                height: "100%",
                name: event.stream.name
            },
            handleCallback
        );
    });
}

function initializeSession(apiKey, sessionId, token, streamName) {
    // Connect to the session
    session.connect(token, error => {
        // If the connection is successful, initialize the publisher and publish to the session
        if (error) {
            handleCallback(error);
        } else {
            session.publish(publisher, handleCallback);
        }
    });
}

function initializeSessionStream(apiKey, sessionId, token) {
    // Connect to the session
    session.connect(token, error => handleCallback(error));
}

function toggleSession(apiKey, sessionId, token) {
    session.disconnect();
    initializeSessionStream(apiKey, sessionId, token)
}

function toggleBack(apiKey, sessionId, token, streamName) {
    session.disconnect();
    initializeSession(apiKey, sessionId, token, streamName)
}

// Callback handler
function handleCallback(error) {
    if (error) {
        console.log("error: " + error.message);
    } else {
        console.log("callback success");
    }
}
