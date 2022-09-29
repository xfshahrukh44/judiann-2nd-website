@extends('front.layouts.app')

@section('title', 'Classroom')
@section('description', '')
@section('keywords', '')

@section('css')
    {{--additional css--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
          integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        id="favicon"
        rel="icon"
        href="https://tokbox.com/developer/favicon.ico"
        type="image/x-icon"
    />

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{asset('admin/stream/style.css')}}"/>
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
                                <video autoplay id="broadcaster" controls></video>
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="video-thumbs lobby_viewers_wrapper">

                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('admin.stopStream', $course->id)}}" method="POST">
            @csrf
            <button type="submit">
                Stop streaming
            </button>
        </form>
    </section>

@endsection

@section('script')
    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>

    {{--additional js--}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/video-streaming-utils.js')}}"></script>
    <script>
        let auth_id = `{{ \Illuminate\Support\Facades\Auth::id() }}`;
        let course_id = `{{ $course->id }}`;

        $(document).ready(function () {
            //establish course_id, session_id, token

            userMediaPermission()
                .then(stream => {
                    broadcaster_stream = stream;
                    broadcaster_stream_original = stream;
                    showMyVideo(stream)
                    peerInit(auth_id).then((newPeer) => {
                        peer = newPeer;
                        /*peer.on("call", (call) => {
                            console.log("onCall", call.peer)
                            call.answer();
                            // // const video = document.createElement("audio");
                            call.on("stream", (broadcaster_stream) => {
                                // console.log("in watcher broadcaster_stream", broadcaster_stream)
                                showBroadcasterVideo(broadcaster_stream)
                                // addVideoStream(video, userVideoStream, call.peer);
                            });
                        });*/
                        broadcasterInitPresenceChannel({echo: window.Echo, auth_id, channel_id: course_id});
                    });

                })
                .catch(err => {
                    alert('Error! ' + err.message)
                })

            /*var conn = peer.connect('peer-course-' + course_id, {
                'host': '/',
                'port': '6002'
            });
            // on open will be launch when you successfully connect to PeerServer
            conn.on('open', function(){
                // here you have conn.id
                // alert('connected to peer');
                conn.send('hi!');
            });*/

            //call
            // var constraints = { video: true, audio: true };
            // var call = peer.call('peer-course-' + course_id, userMediaPermission().then().catch());

            //socket: on viewer raise hand
            window.Echo.channel('user-raised-hand-' + course_id)
                .listen('ViewerRaisedHand', (e) => {
                    toastr.warning('<i class="fa fa-hand-paper-o"></i>' + e.data.customer.name + ' has raised hand.');
                    $('#raised_hand_' + e.data.customer.id).prop('hidden', false);
                    $('#btn_allow_user_screen_' + e.data.customer.id).prop('hidden', false);
                });

            //on allow screen click
            $('body').on('click', '.btn_allow_user_screen', function() {
                //prep data
                var customer_id = $(this).data('user');

                //hide all buttons
                $('.btn_allow_user_screen').each(function() {
                    $(this).prop('hidden', true);
                });
                $('#btn_revert_stream').prop('hidden', false);
                $('#btn_revert_stream').data('user', customer_id);

                const viewer_stream_c = viewer_streams['peer-course-user-' + customer_id]
                const [videoTrack] = viewer_stream_c.getVideoTracks();
                const [audioTrack] = viewer_stream_c.getAudioTracks();
                showMyVideo(viewer_stream_c)
                // const broadcaster_stream_c = broadcaster_stream

                console.log("calls", peer_calls, videoTrack, audioTrack)

                for(let key in peer_calls){
                    if(videoTrack){
                        const sender_video = peer_calls[key].peerConnection.getSenders().find((s) => s.track.kind === videoTrack.kind);
                        sender_video.replaceTrack(videoTrack);
                    }
                    if(audioTrack){
                        const sender_audio = peer_calls[key].peerConnection.getSenders().find((s) => s.track.kind === audioTrack.kind);
                        sender_audio.replaceTrack(audioTrack);
                    }
                }



                /*for(let track of broadcaster_stream.getTracks()){
                    if(track.readyState === 'live' && track.kind === 'audio' && viewer_stream_c.getAudioTracks().length > 0){
                        broadcaster_stream_c.replaceTrack(viewer_stream_c.getAudioTracks()[0])
                    }
                    if(track.readyState === 'live' && track.kind === 'video' && viewer_stream_c.getVideoTracks().length > 0){
                        broadcaster_stream_c.replaceTrack(viewer_stream_c.getVideoTracks()[0])
                    }
                }*/


                // console.log('user stream', viewer_streams['peer-course-user-' + customer_id], broadcaster_stream.getTracks())

                // //toggle session
                // // $('#subscriber').html('');
                // setTimeout(function() {
                //     toggleSession('47561291', session_id, token);
                // }, 5000);
                // $('#publisher').prop('hidden', true);
                // $('#subscriber').prop('hidden', false);
                // $('#btn_revert_stream').prop('hidden', false);
                // $('#btn_revert_stream').data('user', customer_id);

                {{--//ajax to fire event--}}
                /*var url = "{{route('admin.allowUserScreen', ['temp', 'tump'])}}";
                url = url.replace('temp', course_id);
                url = url.replace('tump', customer_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        console.log(res);
                        toggle = true;
                        $('#publisher').html('');
                        $('#subscriber').html('');
                        // getSubscriberToken(session_id);
                        // connectAsSubscriber('47561291', session_id, token);
                        // toggle = true;
                        // viewerToggleBack(customer_id);
                    },
                    error: function () {

                    }
                })*/
            });

            //on revert stream click
            $('body').on('click', '#btn_revert_stream', function() {
                //prep data
                var customer_id = $(this).data('user');

                //hide button
                $(this).prop('hidden', true);

                const [videoTrack] = broadcaster_stream.getVideoTracks();
                const [audioTrack] = broadcaster_stream.getAudioTracks();
                // const broadcaster_stream_c = broadcaster_stream
                showMyVideo(broadcaster_stream)

                console.log("calls", peer_calls, videoTrack, audioTrack)

                for(let key in peer_calls){
                    if(videoTrack){
                        const sender_video = peer_calls[key].peerConnection.getSenders().find((s) => s.track.kind === videoTrack.kind);
                        sender_video.replaceTrack(videoTrack);
                    }
                    if(audioTrack){
                        const sender_audio = peer_calls[key].peerConnection.getSenders().find((s) => s.track.kind === audioTrack.kind);
                        sender_audio.replaceTrack(audioTrack);
                    }
                }
            });

        });
    </script>
@endsection
