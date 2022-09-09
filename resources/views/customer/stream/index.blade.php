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

    {{--additional css--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <h1>Viewer</h1>
    </header>

    <main>
        <div id="subscriber" class="subscriber"></div>
        <div id="publisher" class="publisher"></div>
    </main>

    <main class="container py-4" style="border: solid 1px lightgrey;">
        <button class="btn btn-primary" id="btn_raise_hand"><i class="fa fa-hand-paper-o"></i></button>
    </main>

    <footer>
        <p>
            <small>All rights reserved. </small>
        </p>
    </footer>

    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script src="{{asset('customer/stream/viewer.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    {{--additional js--}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            //establish course_id, session_id, token
            const course_id = window.location.href.split("/").pop();
            const user_id = '{{\Illuminate\Support\Facades\Auth::id()}}';
            var session_id = '{{$course->opentok_session_id}}';
            var token = '{{$token}}';

            //init opentok session
            initializeSession('47561291', session_id, token);
            $('#publisher').prop('hidden', true);

            //socket: on allow user screen
            window.Echo.channel('allow-user-screen-' + course_id + '-' + user_id)
                .listen('AllowUserScreen', (e) => {
                    //toggle session
                    toggleSession('47561291', session_id, token, 'test');
                    $('#publisher').prop('hidden', false);
                    $('#subscriber').prop('hidden', true);
                });

            //socket: on revert stream
            window.Echo.channel('revert-screen-' + course_id + '-' + user_id)
                .listen('RevertStream', (e) => {
                    //toggle session
                    toggleBack('47561291', session_id, token);
                    $('#publisher').prop('hidden', true);
                    $('#subscriber').prop('hidden', false);
                });

            //on raise hand click
            $('#btn_raise_hand').on('click', function() {
                var url = "{{route('customer.raise_hand', 'temp')}}";
                url = url.replace('temp', course_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        console.log(res);
                    },
                    error: function () {

                    }
                })

            });
        });
    </script>
</body>
</html>
