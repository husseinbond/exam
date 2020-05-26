@extends('inc')

@section('content')

<header class="main_menu single_page_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand logo_1" href="index.html"> <img src="img/single_page_logo.png" alt="logo"> </a>
                        <a class="navbar-brand logo_2" href="index.html"> <img src="img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('welcome')}}">Home</a>
                                </li>
                                <li class="nav-item">
                             
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Courses</a>
                                </li>
                               
                                <li class="nav-item">
                            
                                </li>
								@guest
                            <li class="nav-item">
                                <a class="nav-link" class="btn_1" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" class="btn_1" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <a class="dropdown-item"  href="/myclassroom#/mycourses">
                                    
                                       classRoom
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>



    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Our Courses</h2>
                            <p>Home<span>/</span>{{$course->title}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
    

    @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

<section class="course_details_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image">
                        <img class="img-fluid" src="img/single_cource.png" alt="">
                    </div>
                    <div class="content_wrapper">
                        <h4 class="title_top">introduction</h4>
                        <div class="content">
                         {{$course->introduction}}
                        </div>

                        <h4 class="title_top">what is your next</h4>
                        <div class="content">
                         {{$course->whatis}}
                        </div>

                        

                        <h4 class="title_top">Prerequisite Knowledge</h4>
                        <div class="content">
                         {{$course->whatuneed}}
                        </div>
                   
                        <h4 class="title_top">fq</h4>
                        <div class="content">
                         {{$course->fq}}
                        </div>
                   



                        <h4 class="title">Course Outline</h4>
                        <div class="content">
                            <ul class="course_list">
                               
                                @foreach($course->lessons as $lesson)
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>{{$lesson->name}}</p>
                                  
                                </li>
                              @endforeach
                             
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 right-contents">
                    <div class="sidebar_top">
                        <ul>
                        <li>
                                <a class="justify-content-between d-flex" href="#">
                               <p>{{$course->title}}
                                </a>
                            </li>

                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    @if($course->selected == 0)
                                    <p>Course Fee </p>
                                    @endif
                                    @if($course->selected == 1)
                                    <span>${{$course->price}}</span>
                                    @endif
                                </a>
                            </li>
                        

                        </ul>
                        <a href="{{route('enroll' , ['id' => $course->id ])}}" class="btn_1 d-block">Enroll the course</a>
                    </div>

                    <h4 class="title">Reviews</h4>
                    <div class="content">
                      
                        <div class="comments-area mb-30">
                            @foreach($course->comments as $review)
                            @if($review->acc == 1)
                            <div class="comment-list">
                                <div class="single-comment single-reviews justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="img/cource/cource_1.png" alt="">
                                        </div>
                                        <div class="desc">
                                            <h5><a >{{$review->user->name}}</a>
                                            </h5>
                                         
                                            <p class="comment">
                                               {{$review->body}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                         @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="single-footer-widget footer_1">
                        <a href="#"> <img src="/img/logo.png" alt=""> </a>
                        <p>But when shot real her. Chamber her one visite removal six
                            sending himself boys scot exquisite existend an </p>
                        <p>But when shot real her hamber her </p>
                    </div>
                </div>
               
                <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Contact us</h4>
                        <div class="contact_info">
                            <p><span> Address :</span> Hath of it fly signs bear be one blessed after </p>
                            <p><span> Phone :</span> +20 1148026949</p>
                            <p><span> Email : </span>bondbond796@yahoo.com </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright_part_text text-center">
                        <div class="row">
                            <div class="col-lg-12">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
