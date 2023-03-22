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
            port: "3009",
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
                $('.lobby_viewers_wrapper')
                    .append(`<div id="viewer-id-${user.id}">
                                    <div class="thumbBox d-flex align-items-center" style="min-width: 286px; min-height: 250px;">
                                        <div class="text-center" style="width: 100%;">
                                            <i class="fa fa-hand-paper-o text-warning" id="raised_hand_` + user.id + `" hidden></i>
                                            <br />
                                            <img src="`+avatar_image_url+`" style="background-color: white; max-width: 100px; max-height: 100px;">
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
        $('.lobby_viewers_wrapper')
            .append(`<div id="viewer-id-${user.id}">
                                    <div class="thumbBox d-flex align-items-center" style="min-width: 286px; min-height: 250px;">
                                        <div class="text-center" style="width: 100%;">
                                            <i class="fa fa-hand-paper-o text-warning" id="raised_hand_` + user.id + `" hidden></i>
                                            <br />
                                            <img src="`+avatar_image_url+`" style="background-color: white; max-width: 100px; max-height: 100px;">
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
