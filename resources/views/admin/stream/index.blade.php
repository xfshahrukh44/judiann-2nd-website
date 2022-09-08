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

    {{--additional css--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <h1>Participant</h1>
    </header>

    <main>
        <div id="subscriber" class="subscriber"></div>
        <div id="publisher" class="publisher"></div>
    </main>

    {{--Viewer Lobby--}}
    <main class="container py-4" style="border: solid 1px lightgrey;">
        <div class="col-md-12 text-center">
            <h1>Viewer Lobby</h1>
        </div>
        <div class="col-md-12">
            <div class="row lobby_viewers_wrapper">

            </div>
        </div>
    </main>

    <footer>
        <p>
            <small>All rights reserved. </small>
        </p>
    </footer>

    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script src="{{asset('admin/stream/client.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    {{--additional js--}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            //establish course_id
            const course_id = window.location.href.split("/").pop();

            //init socket channel listener
            window.Echo.channel('user-joined-' + course_id)
                .listen('UserJoined', (e) => {
                    toastr.info(e.data.customer.name + ' has joined the session.');
                    inserLobbyViewer(e.data.customer);
                });

            window.Echo.channel('user-raised-hand-' + course_id)
                .listen('ViewerRaisedHand', (e) => {
                    toastr.info('<i class="fa fa-hand-paper-o"></i>' + e.data.customer.name + ' has raised hand.');
                    showRaisedHand(e.data.customer.id);
                });

            //insert newly joined viewer to lobby
            function inserLobbyViewer(viewer) {
                $('.lobby_viewers_wrapper').append(`<div class="col-md-3 text-center py-4" style="border: 1px solid grey;">
                                                        <i class="fa fa-hand-paper-o text-primary" id="raised_hand_`+viewer.id+`" hidden></i>
                                                        <h3>`+viewer.name+`</h3>
                                                        <button class="btn btn-primary btn-sm">Allow screen share</button>
                                                    </div>`);
            }

            //enable raised hand button
            function showRaisedHand(viewer_id) {
                $('#raised_hand_' + viewer_id).prop('hidden', false);
            }
        });
    </script>
</body>
</html>
