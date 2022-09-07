<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stream Video Chat</title>
    <meta name="description" content="Stream a basic audio-video chat plus texting with Vonage Video API in Node.js" />
    <link
        id="favicon"
        rel="icon"
        href="https://tokbox.com/developer/favicon.ico"
        type="image/x-icon"
    />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="{{asset('admin/stream/style.css')}}" />
</head>

<body>
<header>
    <h1>Participant</h1>
</header>

<main>
    <div id="subscriber" class="subscriber"></div>
    <div id="publisher" class="publisher"></div>
</main>

<footer>
    <p>
        <small>All rights reserved. </small>
    </p>
</footer>

<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
<script src="{{asset('admin/stream/client.js')}}"></script>
</body>
</html>
