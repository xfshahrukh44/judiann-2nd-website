@extends('front.layouts.app')

@section('title', 'Classroom')
@section('description', '')
@section('keywords', '')

@section('css')
    {{--additional css--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        id="favicon"
        rel="icon"
        href="https://tokbox.com/developer/favicon.ico"
        type="image/x-icon"
    />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{asset('admin/stream/style.css')}}" />
@endsection


@section('content')

    <style>
        header, footer {
            display: none;
        }
    </style>

    <section class="chattingSec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="videoBox" style="width: 100%">
                        <div class="headingCont">
                            <h3></h3>
                        </div>
                        <div class="videoControllers" style="z-index: 1;">
                            <a href="#" id="btn_revert_stream" data-user="" hidden><i class="fas fa-phone"></i></a>
                        </div>
                        <figure class="videoThumbMain">
                            <div id="subscriber" class="subscriber"></div>
                            <div id="publisher" class="publisher"></div>
                        </figure>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="video-thumbs lobby_viewers_wrapper">

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>

    {{--additional js--}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            //establish course_id, session_id, token
            const course_id = window.location.href.split("/").pop();

            var peer = new Peer('peer-course-' + course_id);
            //when peer is opened
            peer.on('open', function(id) {
                alert('Peer connected. My peer ID is: ' + id);
            });
            //Anytime another peer attempts to connect to your peer ID, you'll receive a connection event.
            peer.on('connection', function(conn) {
                conn.on('data', function(data){
                    // Will print 'hi!'
                    console.log(data);
                    alert('user joined');
                });
            });

            var conn = peer.connect('peer-course-' + course_id, {
                'host': '/',
                'port': '6002'
            });
            // on open will be launch when you successfully connect to PeerServer
            conn.on('open', function(){
                // here you have conn.id
                alert('connected to peer');
                conn.send('hi!');
            });

            //call
            var constraints = { video: true, audio: true };
            var call = peer.call('peer-course-' + course_id, userMediaPermission);


            function userMediaPermission() {
                // Older browsers might not implement mediaDevices at all, so we set an empty object first
                if (navigator.mediaDevices === undefined) {
                    navigator.mediaDevices = {};
                }

                // Some browsers partially implement media devices. We can't just assign an object
                // with getUserMedia as it would overwrite existing properties.
                // Here, we will just add the getUserMedia property if it's missing.
                if (navigator.mediaDevices.getUserMedia === undefined) {
                    navigator.mediaDevices.getUserMedia = function (constraints) {
                        // First get ahold of the legacy getUserMedia, if present
                        const getUserMedia =
                            navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

                        // Some browsers just don't implement it - return a rejected promise with an error
                        // to keep a consistent interface
                        if (!getUserMedia) {
                            return Promise.reject(
                                new Error("getUserMedia is not implemented in this browser")
                            );
                        }

                        // Otherwise, wrap the call to the old navigator.getUserMedia with a Promise
                        return new Promise((resolve, reject) => {
                            getUserMedia.call(navigator, constraints, resolve, reject);
                        });
                    };
                }
                navigator.mediaDevices.getUserMedia =
                    navigator.mediaDevices.getUserMedia ||
                    navigator.webkitGetUserMedia ||
                    navigator.mozGetUserMedia;

                return new Promise((resolve, reject) => {
                    navigator.mediaDevices
                        .getUserMedia({video: true, audio: true})
                        .then(stream => {
                            resolve(stream);
                        })
                        .catch(err => {
                            reject(err);
                            //   throw new Error(`Unable to fetch stream ${err}`);
                        });
                });
            }
        });
    </script>
@endsection
