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
                            <div id="publisher" class="publisher">
                                <video autoplay id="broadcaster"></video>
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="video-thumbs lobby_viewers_wrapper">
                        <main class="container py-4">
                            <button class="btn btn-primary btn-block" id="btn_raise_hand"><i class="fa fa-hand-paper-o"></i></button>
                        </main>
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
    <script src="{{asset('js/video-streaming-utils.js')}}"></script>
    <script>
        let auth_id = `{{ \Illuminate\Support\Facades\Auth::id() }}`;
        let course_id = `{{ $course->id }}`;

        $(document).ready(function() {

            userMediaPermission()
                .then(stream => {
                    broadcaster_stream = stream;
                    peerInit(auth_id).then((newPeer) => {
                        peer = newPeer;
                        peer.on("call", (call) => {
                            console.log("onCall", call.peer)
                            call.answer(stream);
                            // // const video = document.createElement("audio");
                            call.on("stream", (broadcaster_stream) => {
                                console.log("in watcher broadcaster_stream", broadcaster_stream)
                                showBroadcasterVideo(broadcaster_stream)
                                // addVideoStream(video, userVideoStream, call.peer);
                            });
                        });
                        let channel = customerInitPresenceChannel({echo: window.Echo, channel_id: course_id});
                        channel.listen('StopStreaming', () => {
                            window.close();
                        });
                    });

                })
                .catch(err => {
                    alert('Error! ' + err.message)
                })

            //on raise hand click
            $('#btn_raise_hand').on('click', function() {
                var url = "{{route('customer.raise_hand', 'temp')}}";
                let _this = $(this);
                _this.prop('disabled', true);
                url = url.replace('temp', course_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        console.log(res);
                        setTimeout(function() {
                            _this.prop('disabled', true);
                        }, 1000 * 60);
                    },
                    error: function () {

                    }
                })

            });

        });
    </script>
@endsection
