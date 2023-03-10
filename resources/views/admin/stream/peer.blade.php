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
                            <a href="#" id="btn_revert_stream" data-user="" hidden><i class="fas fa-undo"></i></a>
                            <form action="{{route('admin.stopStream', $batch->id)}}" method="POST">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-phone"></i>
                                </button>
                            </form>
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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--    <script src="{{asset('js/video-streaming-utils.js')}}"></script>--}}
    <script>
        let peer = null;
        let peer_calls = {};
        let broadcaster_stream = null;
        let broadcaster_stream_original = null;
        let is_peer_open = false;
        let viewer_streams = [];

        const peerInit = (auth_id) => {

            //Anytime another peer attempts to connect to your peer ID, you'll receive a connection event.
            /*peer.on('connection', function(conn) {
                conn.on('data', function(data){
                    // Will print 'hi!'
                    console.log(data);
                    alert('user joined');
                });
            });*/

            return new Promise(resolve => {
                const peer = new Peer('peer-course-user-' + auth_id, {
                    path: "/peerjs",
                    host: "/",
                    port: "3001",
                });
                //when peer is opened
                peer.on('open', function (id) {
                    console.log("test id", id)
                    is_peer_open = true;
                    resolve(peer);
                    // alert('Peer connected. My peer ID is: ' + id);
                });
            });
        }

        const broadcasterInitPresenceChannel = ({echo, auth_id, channel_id}) => {
            if (!echo || !auth_id || !channel_id) return


            console.log(`streaming-channel.${channel_id}`)
            const channel = echo.join(
                `streaming-channel.${channel_id}`
            );
            channel.here((users) => {
                console.log("all users", users, is_peer_open)
                if (auth_id) {
                    const viewers = _.filter(users, (user) => {
                        return user.id != auth_id
                    })
                    _.each(viewers, (user) => {
                        callingToViewer(user.id);
                        let img_req = getUserProfilePicture(user.id);
                        $('.lobby_viewers_wrapper')
                            .append(`<div id="viewer-id-${user.id}">
                                    <div class="thumbBox d-flex align-items-center" style="min-width: 286px; min-height: 250px;">
                                        <div class="text-center" style="width: 100%;">
                                            <i class="fa fa-hand-paper-o text-warning" id="raised_hand_` + user.id + `" hidden></i>
                                            <br />
                                            <img src="`+img_req.responseText+`" style="background-color: white; max-width: 100px; max-height: 100px;">
                                            <h4 style="color:white;">` + user.name + `</h4>
                                            <button class="btn btn-primary btn-sm btn_allow_user_screen" id="btn_allow_user_screen_` + user.id + `" data-user="` + user.id + `" hidden>Allow screen share</button>
                                        </div>
                                    </div>
                                </div>`);
                    })
                }
            });
            channel.joining((user) => {
                console.log('User Joined', user);
                callingToViewer(user.id);
                toastr.info(user.name + ' has joined the session.');
                let img_req = getUserProfilePicture(user.id);
                $('.lobby_viewers_wrapper')
                    .append(`<div id="viewer-id-${user.id}">
                                    <div class="thumbBox d-flex align-items-center" style="min-width: 286px; min-height: 250px;">
                                        <div class="text-center" style="width: 100%;">
                                            <i class="fa fa-hand-paper-o text-warning" id="raised_hand_` + user.id + `" hidden></i>
                                            <br />
                                            <img src="`+img_req.responseText+`" style="background-color: white; max-width: 100px; max-height: 100px;">
                                            <h4 style="color:white;">` + user.name + `</h4>
                                            <button class="btn btn-primary btn-sm btn_allow_user_screen" id="btn_allow_user_screen_` + user.id + `" data-user="` + user.id + `" hidden>Allow screen share</button>
                                        </div>
                                    </div>
                                </div>`);
            });
            channel.leaving((user) => {
                console.log('User Left', user);
                // console.log(user.name, "Left");
                $(`#viewer-id-${user.id}`).remove()
            });

            return channel;
        }

        const customerInitPresenceChannel = ({echo, channel_id}) => {
            if (!echo || !channel_id) return

            console.log(`streaming-channel.${channel_id}`)
            const channel = echo.join(
                `streaming-channel.${channel_id}`
            );
            /*channel.here((users) => {
                console.log("all users", users, is_peer_open)
                if (auth_id) {
                    const viewers = _.filter(users, (user) => {
                        return user.id !== auth_id
                    })
                    _.each(viewers, (user) => {
                        callingToViewer(user.id);
                    })
                }
            });
            channel.joining((user) => {
                // callingToViewer(user.id);
            });
            channel.leaving((user) => {
                console.log(user.name, "Left");
            });*/

            return channel
        }

        const callingToViewer = (user_id) => {
            if (peer && broadcaster_stream) {
                peer_calls['peer-course-user-' + user_id] = peer.call('peer-course-user-' + user_id, broadcaster_stream)
                let call = peer_calls['peer-course-user-' + user_id]
                call.on('stream', (viewer_stream) => {
                    console.log("in watcher viewer stream", viewer_stream)
                    viewer_streams['peer-course-user-' + user_id] = viewer_stream
                })
                console.log('call senders', peer_calls)
            }
        }

        const userMediaPermission = () => {
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

        const showMyVideo = (stream) => {
            const broadcaster = document.getElementById('broadcaster')
            if (broadcaster) {
                broadcaster.srcObject = stream
                broadcaster.muted = true
                broadcaster.addEventListener("loadedmetadata", () => {
                    // broadcaster.value.controls = true
                    broadcaster.play();
                })
            }
        }

        const showBroadcasterVideo = (stream) => {
            const broadcaster = document.getElementById('broadcaster')
            if (broadcaster) {
                broadcaster.srcObject = stream
                broadcaster.addEventListener("loadedmetadata", () => {
                    // broadcaster.value.controls = true
                    broadcaster.play();
                })
            }
        }

        const getUserProfilePicture = (user_id) => {
            return $.ajax({
                type:'POST',
                url:'{{route("admin.getUserProfilePicture")}}',
                data: {
                    _token: '{{csrf_token()}}',
                    user_id: user_id
                },
                // success:function(data) {
                //     return data;
                // }
            });
        }
    </script>
    <script>
        let auth_id = `{{ \Illuminate\Support\Facades\Auth::id() }}`;
        let batch_id = `{{ $batch->id }}`;
        let avatar_image_url = '{{asset('images/avatar.png')}}';

        $(document).ready(function () {
            //establish batch_id, session_id, token

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
                        broadcasterInitPresenceChannel({echo: window.Echo, auth_id, channel_id: batch_id});
                    });

                })
                .catch(err => {
                    alert('Error! ' + err.message)
                })

            /*var conn = peer.connect('peer-batch-' + batch_id, {
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
            // var call = peer.call('peer-batch-' + batch_id, userMediaPermission().then().catch());

            //socket: on viewer raise hand
            window.Echo.channel('user-raised-hand-' + batch_id)
                .listen('.viewer.raised.hand', (e) => {
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

                const viewer_stream_c = viewer_streams['peer-batch-user-' + customer_id]
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


                // console.log('user stream', viewer_streams['peer-batch-user-' + customer_id], broadcaster_stream.getTracks())

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
                url = url.replace('temp', batch_id);
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
