<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from creativelayers.net/themes/educrat-html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Oct 2025 13:04:57 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet" />
    <!-- fixed CDN URLs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

    <title>Educrat</title>
</head>

<body class="preloader-visible" data-barba="wrapper">
    <!-- preloader start -->
    <div class="preloader js-preloader">
        <div class="preloader__bg"></div>
    </div>
    <!-- preloader end -->

    <main class="main-content bg-beige-1">
        <header data-anim="fade" data-add-bg="" class="header -base js-header">
            <div class="header__container py-10">
                <div class="row justify-between items-center">
                    <div class="col-auto">
                        <div class="header-left">
                            <div class="header__logo">
                                <a data-barba href="{{ url('/') }}">
                                    <img src="{{ asset('assets/img/general/logo.svg') }}" alt="logo" />
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="header-right d-flex items-center">
                            <div class="header-menu js-mobile-menu-toggle">
                                <div class="header-menu__content">
                                    <div class="mobile-bg js-mobile-bg"></div>

                                    <div class="d-none xl:d-flex items-center px-20 py-20 border-bottom-light">
                                        <a href="login.html" class="text-dark-1">Log in</a>
                                        <a href="signup.html" class="text-dark-1 ml-30">Sign Up</a>
                                    </div>



                                    <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
                                        <div class="mobile-footer__number">
                                            <div class="text-17 fw-500 text-dark-1">Call us</div>
                                            <div class="text-17 fw-500 text-purple-1">
                                                800 388 80 90
                                            </div>
                                        </div>

                                        <div class="lh-2 mt-10">
                                            <div>
                                                329 Queensberry Street,<br />
                                                North Melbourne VIC 3051, Australia.
                                            </div>
                                            <div>hi@educrat.com</div>
                                        </div>

                                        <div class="mobile-socials mt-10">
                                            <a href="#"
                                                class="d-flex items-center justify-center rounded-full size-40">
                                                <i class="fa fa-facebook"></i>
                                            </a>

                                            <a href="#"
                                                class="d-flex items-center justify-center rounded-full size-40">
                                                <i class="fa fa-twitter"></i>
                                            </a>

                                            <a href="#"
                                                class="d-flex items-center justify-center rounded-full size-40">
                                                <i class="fa fa-instagram"></i>
                                            </a>

                                            <a href="#"
                                                class="d-flex items-center justify-center rounded-full size-40">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="header-menu-close" data-el-toggle=".js-mobile-menu-toggle">
                                    <div class="size-40 d-flex items-center justify-center rounded-full bg-white">
                                        <div class="icon-close text-dark-1 text-16"></div>
                                    </div>
                                </div>

                                <div class="header-menu-bg"></div>
                            </div>

                            <div class="mr-30">
                                <div class="d-none xl:d-block ml-20">
                                    <button class="text-dark-1 items-center" data-el-toggle=".js-mobile-menu-toggle">
                                        <i class="text-11 icon icon-mobile-menu"></i>
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-wrapper js-content-wrapper">
            <section class="form-page js-mouse-move-container">
                <div class="form-page__img bg-dark-1">
                    <div class="form-page-composition">
                        <div class="-bg">
                            <img data-move="30" class="js-mouse-move" src="{{ asset('assets/img/login/bg.png') }}"
                                alt="bg" />
                        </div>
                        <div class="-el-1">
                            <img data-move="20" class="js-mouse-move" src="{{ asset('assets/img/home-9/hero/bg.png') }}"
                                alt="image" />
                        </div>
                        <div class="-el-2">
                            <img data-move="40" class="js-mouse-move" src="{{ asset('assets/img/home-9/hero/1.png') }}"
                                alt="icon" />
                        </div>
                        <div class="-el-3">
                            <img data-move="40" class="js-mouse-move"
                                src="{{ asset('assets/img/home-9/hero/2.png') }}" alt="icon" />
                        </div>
                        <div class="-el-4">
                            <img data-move="40" class="js-mouse-move"
                                src="{{ asset('assets/img/home-9/hero/3.png') }}" alt="icon" />
                        </div>
                    </div>
                </div>

                <div class="form-page__content lg:py-50">
                    <div class="container">
                        <div class="row justify-center items-center">
                            <div class="col-xl-8 col-lg-9">
                                <div class="px-50 py-50 md:px-25 md:py-25 bg-white shadow-1 rounded-16">
                                    <h3 class="text-30 lh-13">Sign Up</h3>
                                    <p class="mt-10">
                                        Already have an account?
                                        <a href="{{ route('login') }}" class="text-purple-1">Log in</a>
                                    </p>

                                    <form method="POST" action="{{ route('register') }}"
                                        class="contact-form respondForm__form row y-gap-20 pt-30">
                                        @csrf

                                        <div class="col-lg-6 col-12">
                                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Full Name *</label>
                                            <input type="text" name="name" placeholder="Enter your name"
                                                required>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Email Address
                                                *</label>
                                            <input type="email" name="email" placeholder="Enter your email"
                                                required>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Password *</label>
                                            <input type="password" name="password" placeholder="Enter password"
                                                required>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Confirm Password
                                                *</label>
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm password" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Register As *</label>
                                            <select name="role" required class="form-control">
                                                <option value="">Select role</option>
                                                <option value="teacher">Teacher</option>
                                                <option value="student">Student</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit"
                                                class="button -md -green-1 text-dark-1 fw-500 w-1/1">
                                                Register
                                            </button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </section>
        </div>
    </main>


    <!-- JavaScript - fixed CDN URLs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

<!-- Mirrored from creativelayers.net/themes/educrat-html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Oct 2025 13:05:00 GMT -->

</html>
