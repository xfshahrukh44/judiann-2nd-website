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
            init('47561291', session_id);
            getSubscriberToken(session_id);
            connectAsSubscriber('47561291', session_id, token);
            $('#publisher').prop('hidden', true);

            //socket: on allow user screen
            window.Echo.channel('allow-user-screen-' + course_id + '-' + user_id)
                .listen('AllowUserScreen', (e) => {
                    //toggle session
                    $('.videoThumbMain').html('<div id="publisher" class="publisher"></div>');
                    $('#publisher').prop('hidden', false);
                    $('#subscriber').prop('hidden', true);

                    // $('#publisher').html('');
                    // $('#subscriber').html('');
                    getPublisherToken(session_id);
                    connectAsPublisher('47561291', session_id, token);
                });

            //socket: on revert stream
            window.Echo.channel('revert-screen-' + course_id + '-' + user_id)
                .listen('RevertStream', (e) => {
                    //append publisher div to video box
                    $('.videoThumbMain').html('<div id="subscriber" class="subscriber"></div>');

                    //toggle session
                    $('body #publisher').prop('hidden', true);
                    $('.subscriber').prop('hidden', false);

                    // $('#publisher').html('');
                    // $('#subscriber').html('');
                    getSubscriberToken(session_id);
                    connectAsSubscriber('47561291', session_id, token);
                });

            //socket: on viewer toggle back
            window.Echo.channel('viewer-toggle-back-' + course_id)
                .listen('ViewerToggleBack', (e) => {
                    if(e.customer_id != user_id) {
                        $('#publisher').prop('hidden', true);
                        $('#subscriber').prop('hidden', false);
                        // $('#publisher').html('');
                        // $('#subscriber').html('');
                        getSubscriberToken(session_id);
                        connectAsSubscriber('47561291', session_id, token);
                    }
                    else {
                        $('#publisher').prop('hidden', false);
                        $('#subscriber').prop('hidden', true);

                        // $('#publisher').html('');
                        // $('#subscriber').html('');
                        getPublisherToken(session_id);
                        connectAsPublisher('47561291', session_id, token);
                    }
                });

            function getPublisherToken(session_id) {
                var url = `{{route('customer.getPublisherToken', 'temp')}}`;
                url = url.replace('temp', session_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        // token = res;
                        token = `{{session()->get('publisher_token')}}`;
                    },
                    error: function () {

                    }
                })
            }

            function getSubscriberToken(session_id) {
                var url = `{{route('customer.getSubscriberToken', 'temp')}}`;
                url = url.replace('temp', session_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        // token = res;
                        token = `{{session()->get('subscriber_token')}}`;
                    },
                    error: function () {

                    }
                })
            }

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
@endsection
