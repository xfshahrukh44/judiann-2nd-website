/*fetch(location.pathname, { method: "POST" })
  .then(res => {
    return res.json();
  })
  .then(res => {
    const apiKey = res.apiKey;
    const sessionId = res.sessionId;
    const token = res.token;
    initializeSession(apiKey, sessionId, token);
  })
  .catch(handleCallback);*/

initializeSession('47561291', '1_MX40NzU2MTI5MX5-MTY2MjU3MTg2NTk5MH5PQnlRcndVYTNicDFSRldTZEtKL1hOSU5-fg', 'T1==cGFydG5lcl9pZD00NzU2MTI5MSZzaWc9YTIxNzQ1ZTEwMjE0M2IwNDdlZDAwZDQ0MjY1ODk0NzI1NDg5NGZkZTpzZXNzaW9uX2lkPTFfTVg0ME56VTJNVEk1TVg1LU1UWTJNalUzTVRnMk5UazVNSDVQUW5sUmNuZFZZVE5pY0RGU1JsZFRaRXRLTDFoT1NVNS1mZyZjcmVhdGVfdGltZT0xNjYyNTcxODgwJm5vbmNlPTAuMTE0OTMwOTU1MjY3NTQxMjcmcm9sZT1wdWJsaXNoZXImZXhwaXJlX3RpbWU9MTY2NTE2Mzc4MyZpbml0aWFsX2xheW91dF9jbGFzc19saXN0PQ==');

function initializeSession(apiKey, sessionId, token) {
    // Create a session object with the sessionId
    const session = OT.initSession(apiKey, sessionId);

    // Connect to the session
    session.connect(token, error => handleCallback(error));

    // Subscribe to a newly created stream
    session.on("streamCreated", event => {
        session.subscribe(event.stream, "subscriber", {
            insertMode: "append",
            width: "50%",
            height: "50%",
            name: event.stream.name
        }, handleCallback);
    });
}

// Callback handler
function handleCallback(error) {
    if (error) {
        console.log("error: " + error.message);
    } else {
        console.log("callback success");
    }
}
