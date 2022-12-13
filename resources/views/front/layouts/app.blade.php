<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <link rel="stylesheet" href="{{asset('front/css/custom.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/toastr/toastr.min.css')}}">
    <title>@yield('title')
        | {{(isset($setting) && !is_null($setting['site_title'])) ? $setting['site_title'] : 'Judiann 2nd Website'}}</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
@yield('css')

<body>
<!-- Begin: Header -->
<header class="wow fadeInDown" data-wow-delay="0.5s">
    <div class="main-navigate">
        <div class="an-navbar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6">
                        <a href="{{route('front.home')}}">
                            <lottie-player src="{{asset('front/images/logo.json')}}" background="transparent" speed="1"
                                           style="width: 300px; height: 150px;"  class="logo"  loop autoplay></lottie-player>
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="d-flex align-items-center justify-content-end">
                            <ul class="navbar-nav d-inline-flex justify-content-end mr-3">
                                <li class="nav-item">
                                    <button type="button" data-toggle="modal" data-target="#loginModal" class="nav-link text-white h5 btn">Login</button>
                                </li>
                            </ul>
                            <div id="myNav" class="overlay">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                                <div class="overlay-content">
                                    <ul class="">
                                        <li class="active  nav-item"><a class="nav-link" href="{{route('front.home')}}">Home</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link"
                                                                href="{{route('front.about-judiann')}}">About
                                                Judiann</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{route('front.about-us')}}">About
                                                Us</a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                                href="{{route('front.judiann-portfolio')}}">Judiann’s
                                                Portfolio</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{route('front.services')}}">Services</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link"
                                                                href="{{route('front.faqs')}}">Faq’s</a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                                href="{{route('front.students-work')}}">Student’s
                                                Work</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{route('front.contact')}}">Contact
                                                Us</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{route('front.terms')}}">Terms &
                                                Conditions</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{route('front.policy')}}">Privacy
                                                Policy</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{route('front.schedule')}}">Schedule
                                                A Class</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- END: Header -->

@yield('content')

<!-- <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12"></div>
                </div>
            </div>
        </section> -->

<!-- Begin: Footer -->
<footer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-2">
                <a href="{{route('front.home')}}" class="ftrLogo"><img src="{{asset('front/images/logo.png')}}"
                                                                       class="img-fluid" alt="img"></a>
            </div>
            <div class="col-md-2">
                <div class="ftrContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="{{route('front.home')}}"><span>Home</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('front.about-judiann')}}"><span>About Judiann</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('front.about-us')}}"><span>About Us</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('front.faqs')}}"><span>Faq’s</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('front.judiann-portfolio')}}"><span>Judiann’s Portfolio</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('front.services')}}"><span>Services</span></a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('front.students-work')}}"><span>Student’s Work</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('front.contact')}}"><span>Contact Us</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('front.schedule')}}"><span>Schedule A Class</span></a>
                        <li class="nav-item"><a class="nav-link" href="{{route('front.testimonial')}}"><span>Testimonials</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="ftrLst">
                    <a href="tel:+912-483-3600">912-483-3600</a>
                    <a href="mailto:info@judiannsfashiondesignstudios.com">info@judiannsfashiondesignstudios.com</a>
                    <a href="#">122 N. Laurel St. Suite A, <br> Springfield, Georgia 31329</a>
                    <a href="#">View Larger Map</a>
                </div>
            </div>
        </div>


    </div>
    <div class="copyRght">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <p>Copyright © 2022 • All Rights Reserved. </p>
                </div>
                <div class="col-md-4">
                    <ul class="policy">
                        <li><a href="{{route('front.policy')}}">Policies</a></li>
                        <li><a href="{{route('front.terms')}}">terms and conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="ftrSocial">
                        <li><a href="https://www.facebook.com/profile.php?id=100085857340410"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/j.ebyjudiann/"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://twitter.com/JudiannEchezab1"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.tiktok.com/@j.ebyjudiann?_t=8VH4jKe6Im9&_r=1"><img width="16"
                                                                                                    height="16"
                                                                                                    src="{{asset('front/images/tiktokLogo.jpg')}}"
                                                                                                    alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- END: Footer -->

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-top-0">
                <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-white" for="">Email</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-white" for=""></label>
                                <input type="password" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="themeBtn py-1">
                                    Login
                                </button>
                                <div class="d-flex flex-column justify-content-end text-right">
                                    <a href="{{route('front.forget')}}" class="text-white">Forget Password</a>
                                    <a href="{{route('front.signup')}}" class="text-white">Not a member? Signup</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('front/js/all.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@1.5.7/dist/lottie-player.js"></script>
<script src="{{asset('front/js/custom.min.js')}}"></script>
<script src="{{URL:: asset('admin/plugins/toastr/toastr.min.js')}}"></script>
@if(session()->has('success'))
    <script type="text/javascript">  toastr.success('{{ session('success')}}');</script>
@endif
@if(session()->has('error'))
    <script type="text/javascript"> toastr.error('{{ session('error')}}');</script>
@endif

@yield('script')


</body>

</html>
