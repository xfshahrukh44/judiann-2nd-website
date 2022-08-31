<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/css/custom.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}"/>
    <title>@yield('title') | {{(isset($settings) && key_exists('site_title', $settings) && !is_null($settings['site_title'])) ? $settings['site_title'] : 'Judiann 2nd Website'}}</title>
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
                    <div class="col-md-6">
                        <a href="index.php">
                            <lottie-player src="{{asset('front/images/logo.json')}}" background="transparent" speed="1"
                                           style="width: 300px; height: 150px;" loop autoplay></lottie-player>
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <div id="myNav" class="overlay">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                            <div class="overlay-content">
                                <ul class="">
                                    <li class="active  nav-item"><a class="nav-link" href="index.php">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="about-judiann.php">About Judiann</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
                                    <li class="nav-item"><a class="nav-link" href="judiann-portfolio.php">Judiann’s
                                            Portfolio</a></li>
                                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                                    <li class="nav-item"><a class="nav-link" href="faqs.php">Faq’s</a></li>
                                    <li class="nav-item"><a class="nav-link" href="students-work.php">Student’s Work</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                                    <li class="nav-item"><a class="nav-link" href="schedule.php">Schedule A Class</a>
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
                <a href="index.php" class="ftrLogo"><img src="{{asset('front/images/logo.png')}}" class="img-fluid" alt="img"></a>
            </div>
            <div class="col-md-2">
                <div class="ftrContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php"><span>Home</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="about-judiann.php"><span>About Judiann</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="about-us.php"><span>About Us</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="faqs.php"><span>Faq’s</span></a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="judiann-portfolio.php"><span>Judiann’s Portfolio</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="services.php"><span>Services</span></a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="students-work.php"><span>Student’s Work</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php"><span>Contact Us</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="schedule.php"><span>Schedule A Class</span></a>
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
                        <li><a href="#">Policies,</a></li>
                        <li><a href="#">terms and conditions, </a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="ftrSocial">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- END: Footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('front/js/all.min.js')}}"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@1.5.7/dist/lottie-player.js"></script>
<script src="{{asset('front/js/custom.min.js')}}"></script>
@if(session()->has('success'))
    <script type="text/javascript">  toastr.success('{{ session('success')}}');</script>
@endif
@if(session()->has('error'))
    <script type="text/javascript"> toastr.error('{{ session('error')}}');</script>
@endif

@yield('script')



</body>

</html>
