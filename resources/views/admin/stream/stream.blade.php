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
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script src="{{asset('admin/stream/client.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    {{--additional js--}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            //establish course_id, session_id, token
            const course_id = window.location.href.split("/").pop();
            var session_id = '{{$course->opentok_session_id}}';
            var token = '{{$token}}';
            var toggle = false;

            //init opentok session
            init('47561291', session_id);
            initializeSession('47561291', session_id, token, 'test');
            $('#subscriber').prop('hidden', true);

            //socket: on viewer join
            window.Echo.channel('user-joined-' + course_id)
                .listen('UserJoined', (e) => {
                    toastr.info(e.data.customer.name + ' has joined the session.');
                    // $('.lobby_viewers_wrapper').append(`<div class="col-md-3 text-center py-4" style="border: 1px solid grey;">
                    //                                     <i class="fa fa-hand-paper-o text-warning" id="raised_hand_`+e.data.customer.id+`" hidden></i>
                    //                                     <h3>`+e.data.customer.name+`</h3>
                    //                                     <button class="btn btn-primary btn-sm btn_allow_user_screen" data-user="`+e.data.customer.id+`">Allow screen share</button>
                    //                                 </div>`);
                    $('.lobby_viewers_wrapper')
                        .append(`<div>
                                    <div class="thumbBox d-flex align-items-center" style="min-width: 286px; min-height: 250px;">
                                        <div class="text-center" style="width: 100%;">
                                            <i class="fa fa-hand-paper-o text-warning" id="raised_hand_`+e.data.customer.id+`" hidden></i>
                                            <h4 style="color:white;">`+e.data.customer.name+`</h4>
                                            <button class="btn btn-primary btn-sm btn_allow_user_screen" id="btn_allow_user_screen_`+e.data.customer.id+`" data-user="`+e.data.customer.id+`" hidden>Allow screen share</button>
                                        </div>
                                    </div>
                                </div>`);
                });

            //socket: on viewer raise hand
            window.Echo.channel('user-raised-hand-' + course_id)
                .listen('ViewerRaisedHand', (e) => {
                    toastr.warning('<i class="fa fa-hand-paper-o"></i>' + e.data.customer.name + ' has raised hand.');
                    $('#raised_hand_' + e.data.customer.id).prop('hidden', false);
                    $('#btn_allow_user_screen_' + e.data.customer.id).prop('hidden', false);
                });

            //socket: on viewer toggle back
            window.Echo.channel('viewer-toggle-back-' + course_id)
                .listen('ViewerToggleBack', (e) => {
                    if(toggle) {
                        // $('#subscriber').html('');
                        setTimeout(function() {
                            toggleBack('47561291', session_id, token);
                        }, 5000);
                    }
                });

            function viewerToggleBack(customer_id) {
                //ajax to fire event
                var url = "{{route('admin.viewerToggleBack', ['temp', 'tump'])}}";
                url = url.replace('temp', course_id);
                url = url.replace('tump', customer_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        console.log(res);
                    },
                    error: function () {

                    }
                })
            }

            //on allow screen click
            $('body').on('click', '.btn_allow_user_screen', function() {
                //prep data
                var customer_id = $(this).data('user');

                //hide all buttons
                $('.btn_allow_user_screen').each(function() {
                    $(this).prop('hidden', true);
                });

                //toggle session
                // $('#subscriber').html('');
                // $('#subscriber').find(":first-child").remove();
                setTimeout(function() {
                    toggleSession('47561291', session_id, token);
                }, 5000);
                $('#publisher').prop('hidden', true);
                $('#subscriber').prop('hidden', false);
                $('#btn_revert_stream').prop('hidden', false);
                $('#btn_revert_stream').data('user', customer_id);

                //ajax to fire event
                var url = "{{route('admin.allowUserScreen', ['temp', 'tump'])}}";
                url = url.replace('temp', course_id);
                url = url.replace('tump', customer_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        console.log(res);
                        toggle = true;
                        viewerToggleBack(customer_id);
                    },
                    error: function () {

                    }
                })
            });

            //on revert stream click
            $('body').on('click', '#btn_revert_stream', function() {
                //prep data
                var customer_id = $(this).data('user');

                //hide button
                $(this).prop('hidden', true);
                // $('.btn_allow_user_screen').each(function() {
                //     $(this).prop('hidden', false);
                // });

                //toggle session
                toggleBack('47561291', session_id, token, 'test');
                $('#publisher').prop('hidden', false);
                $('#subscriber').prop('hidden', true);

                //ajax to fire event
                var url = "{{route('admin.revertStream', ['temp', 'tump'])}}";
                url = url.replace('temp', course_id);
                url = url.replace('tump', customer_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        console.log(res);
                        viewerToggleBack(customer_id)
                    },
                    error: function () {

                    }
                })
            });
        });
    </script>
@endsection
