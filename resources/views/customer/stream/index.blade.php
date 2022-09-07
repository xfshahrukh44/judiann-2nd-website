<html lang="en">
<head>
    <title>Stream your video chat</title>
    <meta
        name="description"
        content="Stream a basic audio-video chat with Vonage Video API in Node.js"
    />
    <link
        id="favicon"
        rel="icon"
        href="https://tokbox.com/developer/favicon.ico"
        type="image/x-icon"
    />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="{{asset('customer/stream/style.css')}}" />
</head>

<body>
<header>
    <h1>Viewer</h1>
</header>

<main>
    <div id="subscriber" class="subscriber"></div>
</main>

<footer>
    <p>
        <small>All rights reserved. </small>
    </p>
</footer>

<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
<script src="{{asset('customer/stream/viewer.js')}}"></script>
</body>
</html>
