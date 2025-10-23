<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from creativelayers.net/themes/educrat-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Oct 2025 13:04:07 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>


    <link rel="stylesheet" href="../../../cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../../unpkg.com/leaflet%401.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.jpg') }}">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <title>Educrat</title>
    @stack('title')
    @stack('styles')
</head>

<body class="preloader-visible" data-barba="wrapper">
    <!-- preloader start -->
    <div class="preloader js-preloader">
        <div class="preloader__bg"></div>
    </div>
    <!-- preloader end -->


    <main class="main-content  ">

        <header data-anim="fade" data-add-bg="bg-dark-1" class="header -type-1 js-header">


            <div class="header__container">
                <div class="row justify-between items-center">

                    <div class="col-auto">
                        <div class="header-left">

                            <div class="header__logo ">
                                <a data-barba href="{{ url('/') }}">
                                    <img src="{{ asset('assets/img/general/logo.svg') }}" alt="logo">
                                </a>
                            </div>


                            <div class="header__explore text-green-1 ml-60 xl:ml-30 xl:d-none">
                                <a href="#" class="d-flex items-center" data-el-toggle=".js-explore-toggle">
                                    <i class="icon icon-explore mr-15"></i>
                                    Explore
                                </a>

                                <div class="explore-content py-25 rounded-8 bg-white toggle-element js-explore-toggle">

                                    <div class="explore__item">
                                        <a href="#" class="d-flex items-center justify-between text-dark-1">
                                            Architecture<div class="icon-chevron-right text-11"></div>
                                        </a>
                                        <div class="explore__subnav rounded-8">
                                            <a class="text-dark-1" href="courses-single-1.html">Web Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Graphic Design</a>
                                            <a class="text-dark-1" href="courses-single-3.html">Design Tools</a>
                                            <a class="text-dark-1" href="courses-single-4.html">User Experience
                                                Design</a>
                                            <a class="text-dark-1" href="courses-single-5.html">Game Design</a>
                                            <a class="text-dark-1" href="courses-single-6.html">3D & Animation</a>
                                            <a class="text-dark-1" href="courses-single-1.html">Fashion Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Interior Design</a>
                                        </div>
                                    </div>

                                    <div class="explore__item">
                                        <a href="#" class="d-flex items-center justify-between text-dark-1">
                                            Business<div class="icon-chevron-right text-11"></div>
                                        </a>
                                        <div class="explore__subnav rounded-8">
                                            <a class="text-dark-1" href="courses-single-1.html">Web Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Graphic Design</a>
                                            <a class="text-dark-1" href="courses-single-3.html">Design Tools</a>
                                            <a class="text-dark-1" href="courses-single-4.html">User Experience
                                                Design</a>
                                            <a class="text-dark-1" href="courses-single-5.html">Game Design</a>
                                            <a class="text-dark-1" href="courses-single-6.html">3D & Animation</a>
                                            <a class="text-dark-1" href="courses-single-1.html">Fashion Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Interior Design</a>
                                        </div>
                                    </div>


                                    <div class="explore__item">
                                        <a href="#" class="text-dark-1">Computer Programming</a>
                                    </div>

                                    <div class="explore__item">
                                        <a href="#" class="text-dark-1">Data Analysis</a>
                                    </div>


                                    <div class="explore__item">
                                        <a href="#" class="d-flex items-center justify-between text-dark-1">
                                            Design<div class="icon-chevron-right text-11"></div>
                                        </a>
                                        <div class="explore__subnav rounded-8">
                                            <a class="text-dark-1" href="courses-single-1.html">Web Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Graphic Design</a>
                                            <a class="text-dark-1" href="courses-single-3.html">Design Tools</a>
                                            <a class="text-dark-1" href="courses-single-4.html">User Experience
                                                Design</a>
                                            <a class="text-dark-1" href="courses-single-5.html">Game Design</a>
                                            <a class="text-dark-1" href="courses-single-6.html">3D & Animation</a>
                                            <a class="text-dark-1" href="courses-single-1.html">Fashion Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Interior Design</a>
                                        </div>
                                    </div>

                                    <div class="explore__item">
                                        <a href="courses-single-6.html" class="text-dark-1">Education</a>
                                    </div>


                                    <div class="explore__item">
                                        <a href="#" class="d-flex items-center justify-between text-dark-1">
                                            Electronics<div class="icon-chevron-right text-11"></div>
                                        </a>
                                        <div class="explore__subnav rounded-8">
                                            <a class="text-dark-1" href="courses-single-1.html">Web Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Graphic Design</a>
                                            <a class="text-dark-1" href="courses-single-3.html">Design Tools</a>
                                            <a class="text-dark-1" href="courses-single-4.html">User Experience
                                                Design</a>
                                            <a class="text-dark-1" href="courses-single-5.html">Game Design</a>
                                            <a class="text-dark-1" href="courses-single-6.html">3D & Animation</a>
                                            <a class="text-dark-1" href="courses-single-1.html">Fashion Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Interior Design</a>
                                        </div>
                                    </div>

                                    <div class="explore__item">
                                        <a href="#" class="d-flex items-center justify-between text-dark-1">
                                            Language<div class="icon-chevron-right text-11"></div>
                                        </a>
                                        <div class="explore__subnav rounded-8">
                                            <a class="text-dark-1" href="courses-single-1.html">Web Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Graphic Design</a>
                                            <a class="text-dark-1" href="courses-single-3.html">Design Tools</a>
                                            <a class="text-dark-1" href="courses-single-4.html">User Experience
                                                Design</a>
                                            <a class="text-dark-1" href="courses-single-5.html">Game Design</a>
                                            <a class="text-dark-1" href="courses-single-6.html">3D & Animation</a>
                                            <a class="text-dark-1" href="courses-single-1.html">Fashion Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Interior Design</a>
                                        </div>
                                    </div>

                                    <div class="explore__item">
                                        <a href="#" class="d-flex items-center justify-between text-dark-1">
                                            Marketing<div class="icon-chevron-right text-11"></div>
                                        </a>
                                        <div class="explore__subnav rounded-8">
                                            <a class="text-dark-1" href="courses-single-1.html">Web Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Graphic Design</a>
                                            <a class="text-dark-1" href="courses-single-3.html">Design Tools</a>
                                            <a class="text-dark-1" href="courses-single-4.html">User Experience
                                                Design</a>
                                            <a class="text-dark-1" href="courses-single-5.html">Game Design</a>
                                            <a class="text-dark-1" href="courses-single-6.html">3D & Animation</a>
                                            <a class="text-dark-1" href="courses-single-1.html">Fashion Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Interior Design</a>
                                        </div>
                                    </div>


                                    <div class="explore__item">
                                        <a href="#" class="text-dark-1">Music Arts</a>
                                    </div>

                                    <div class="explore__item">
                                        <a href="#" class="text-dark-1">Social Science</a>
                                    </div>


                                    <div class="explore__item">
                                        <a href="#" class="d-flex items-center justify-between text-dark-1">
                                            Photography & Video<div class="icon-chevron-right text-11"></div>
                                        </a>
                                        <div class="explore__subnav rounded-8">
                                            <a class="text-dark-1" href="courses-single-1.html">Web Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Graphic Design</a>
                                            <a class="text-dark-1" href="courses-single-3.html">Design Tools</a>
                                            <a class="text-dark-1" href="courses-single-4.html">User Experience
                                                Design</a>
                                            <a class="text-dark-1" href="courses-single-5.html">Game Design</a>
                                            <a class="text-dark-1" href="courses-single-6.html">3D & Animation</a>
                                            <a class="text-dark-1" href="courses-single-1.html">Fashion Design</a>
                                            <a class="text-dark-1" href="courses-single-2.html">Interior Design</a>
                                        </div>
                                    </div>

                                    <div class="explore__item">
                                        <a href="courses-single-1.html" class="text-dark-1">IT & Software</a>
                                    </div>

                                    <div class="explore__item">
                                        <a href="courses-single-2.html" class="text-purple-1 underline">View All
                                            Courses</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="header-menu js-mobile-menu-toggle ">
                        <div class="header-menu__content">
                            <div class="mobile-bg js-mobile-bg"></div>

                            <div class="d-none xl:d-flex items-center px-20 py-20 border-bottom-light">
                                <a href="{{ route('login') }}" class="text-dark-1">Log in</a>
                                <a href="{{ route('register') }}" class="text-dark-1 ml-30">Sign Up</a>
                            </div>

                            <div class="menu js-navList">
                                <ul class="menu__nav text-white -is-active">
                                    <li class="menu-item-has-children">
                                        <a data-barba href="#">
                                            Home <i class="icon-chevron-right text-13 ml-10"></i>
                                        </a>

                                        <ul class="subnav">
                                            <li class="menu__backButton js-nav-list-back">
                                                <a href="{{ url('/') }}"><i
                                                        class="icon-chevron-left text-13 mr-10"></i>
                                                    Home</a>
                                            </li>

                                            <li><a href="{{ url('/') }}">Home</a></li>

                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a data-barba href="#">
                                            Courses <i class="icon-chevron-right text-13 ml-10"></i>
                                        </a>

                                        <ul class="subnav">


                                            <li><button id="scrollBtn" class="pl-4">Go to Courses</button></li>

                                        </ul>
                                    </li>

                                    <li>
                                        <a data-barba href="contact-1.html">Contact</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
                                <div class="mobile-footer__number">
                                    <div class="text-17 fw-500 text-dark-1">Call us</div>
                                    <div class="text-17 fw-500 text-purple-1">800 388 80 90</div>
                                </div>

                                <div class="lh-2 mt-10">
                                    <div>329 Queensberry Street,<br> North Melbourne VIC 3051, Australia.</div>
                                    <div>hi@educrat.com</div>
                                </div>

                                <div class="mobile-socials mt-10">

                                    <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                                        <i class="fa fa-facebook"></i>
                                    </a>

                                    <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                                        <i class="fa fa-twitter"></i>
                                    </a>

                                    <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                                        <i class="fa fa-instagram"></i>
                                    </a>

                                    <a href="#" class="d-flex items-center justify-center rounded-full size-40">
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


                    <div class="col-auto">
                        <div class="header-right d-flex items-center">
                            <div class="header-right__icons text-white d-flex items-center">

                                <div class="">
                                    <button class="d-flex items-center text-white" data-el-toggle=".js-search-toggle">
                                        <i class="text-20 icon icon-search"></i>
                                    </button>

                                    <div class="toggle-element js-search-toggle">
                                        <div class="header-search pt-90 bg-white shadow-4">
                                            <div class="container">
                                                <div class="header-search__field">
                                                    <div class="icon icon-search text-dark-1"></div>
                                                    <input type="text"
                                                        class="col-12 text-18 lh-12 text-dark-1 fw-500"
                                                        id="courseSearch" placeholder="What do you want to learn?">

                                                    <button
                                                        class="d-flex items-center justify-center size-40 rounded-full bg-purple-3"
                                                        data-el-toggle=".js-search-toggle">
                                                        <img src="{{ asset('assets/img/menus/close.svg') }}"
                                                            alt="icon">
                                                    </button>
                                                </div>

                                                <div class="header-search__content mt-30">
                                                    <div class="text-17 text-dark-1 fw-500">Popular Right Now</div>

                                                    <div class="d-flex y-gap-5 flex-column mt-20"
                                                        id="coursesContainer">


                                                    </div>

                                                    <div class="mt-30">
                                                        <button class="uppercase underline">PRESS ENTER TO SEE ALL
                                                            SEARCH RESULTS</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="header-search__bg" data-el-toggle=".js-search-toggle"></div>
                                    </div>
                                </div>


                                <div class="relative ml-30 xl:ml-20">
                                    <a class="d-flex items-center text-white"
                                        href="{{ auth()->check() ? route('student.view.cart') : route('login') }}">
                                        <i class="text-20 icon icon-basket"></i>
                                    </a>

                                    <div class="toggle-element js-cart-toggle">
                                        <div class="header-cart bg-white -dark-bg-dark-1 rounded-8">
                                            <div class="px-30 pt-30 pb-10">

                                                <div class="row justify-between x-gap-40 pb-20">
                                                    <div class="col">
                                                        <div class="row x-gap-10 y-gap-10">
                                                            <div class="col-auto">
                                                                <img src="{{ asset('assets/img/menus/cart/1.png') }}"
                                                                    alt="image">
                                                            </div>

                                                            <div class="col">
                                                                <div class="text-dark-1 lh-15">The Ultimate Drawing
                                                                    Course Beginner to Advanced...</div>

                                                                <div class="d-flex items-center mt-10">
                                                                    <div
                                                                        class="lh-12 fw-500 line-through text-light-1 mr-10">
                                                                        $179</div>
                                                                    <div class="text-18 lh-12 fw-500 text-dark-1">$79
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <button><img src="{{ asset('assets/img/menus/close.svg') }}"
                                                                alt="icon"></button>
                                                    </div>
                                                </div>

                                                <div class="row justify-between x-gap-40 pb-20">
                                                    <div class="col">
                                                        <div class="row x-gap-10 y-gap-10">
                                                            <div class="col-auto">
                                                                <img src="{{ asset('assets/img/menus/cart/2.png') }}"
                                                                    alt="image">
                                                            </div>

                                                            <div class="col">
                                                                <div class="text-dark-1 lh-15">User Experience Design
                                                                    Essentials - Adobe XD UI UX...</div>

                                                                <div class="d-flex items-center mt-10">
                                                                    <div
                                                                        class="lh-12 fw-500 line-through text-light-1 mr-10">
                                                                        $179</div>
                                                                    <div class="text-18 lh-12 fw-500 text-dark-1">$79
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <button><img src="{{ asset('assets/img/menus/close.svg') }}"
                                                                alt="icon"></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="px-30 pt-20 pb-30 border-top-light">
                                                <div class="d-flex justify-between">
                                                    <div class="text-18 lh-12 text-dark-1 fw-500">Total:</div>
                                                    <div class="text-18 lh-12 text-dark-1 fw-500">$659</div>
                                                </div>

                                                <div class="row x-gap-20 y-gap-10 pt-30">
                                                    <div class="col-sm-6">
                                                        <button
                                                            class="button py-20 -dark-1 text-white -dark-button-white col-12">View
                                                            Cart</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button
                                                            class="button py-20 -purple-1 text-white col-12">Checkout</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-none xl:d-block ml-20">
                                    <button class="text-white items-center" data-el-toggle=".js-mobile-menu-toggle">
                                        <i class="text-11 icon icon-mobile-menu"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="header-right__buttons d-flex items-center ml-30 md:d-none">
                                @if (!Auth::check())
                                    <a href="{{ route('login') }}" class="button -underline text-white">Log in</a>
                                    <a href="{{ route('register') }}"
                                        class="button -sm -white text-dark-1 ml-30">Sign
                                        up</a>
                                @else
                                    <a href=" @if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }}
    @elseif(auth()->user()->role === 'teacher')
        {{ route('teacher.dashboard') }}
    @else
        {{ route('student.dashboard') }} @endif"
                                        class="button -underline text-white mr-2">Dashboard</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="button -sm -white text-dark-1 ml-30">
                                            Logout
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <div class="content-wrapper js-content-wrapper">
