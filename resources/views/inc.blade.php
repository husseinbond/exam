<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Etrain</title>
    <link rel="icon" href="img/favicon.png ">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" {{asset('css/front/bootstrap.min.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href=" {{asset('css/front/animate.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href=" {{asset('css/front/owl.carousel.min.css')}}">
    <!-- themify CSS -->
    <link rel="stylesheet" href=" {{asset('css/front/themify-icons.css')}}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href=" {{asset('css/front/flaticon.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href=" {{asset('css/front/magnific-popup.css')}}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href=" {{asset('css/front/slick.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href=" {{asset('css/front/style.css')}}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <style>
div.vue {
  margin-bottom: 200px;
  
}

div.space {
  margin: 20px;
  
}



div.vato{
    top: -200px;
    position: relative;

}


div.vito{
    top: -200px;
    position: relative;
    left:26%;
}







</style>
    
</head>

<body>



    <main id="app" >
            @yield('content')
        </main>
        <script src="http://127.0.0.1:8000/js/front/app.js" async></script>
        <script src="js/front/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src=" {{asset('js/front/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src=" {{asset('js/front/bootstrap.min.js')}}"></script>
    <!-- easing js -->
    <script src=" {{asset('js/front/jquery.magnific-popup.js')}}"></script>
    <!-- swiper js -->
    <script src=" {{asset('js/front/swiper.min.js')}}"></script>
    <!-- swiper js -->
    <script src=" {{asset('js/front/masonry.pkgd.js')}}"></script>
    <!-- particles js -->
    <script src="  {{asset('js/front/owl.carousel.min.js')}}"></script>
    <script src=" {{asset('js/front/jquery.nice-select.min.js')}}" ></script>
    <!-- swiper js -->
    <script src=" {{asset('js/front/slick.min.js')}}"></script>
    <script src=" {{asset('js/front/jquery.counterup.min.js')}}"></script>
    <script src=" {{asset('js/front/waypoints.min.js')}}"></script>
    <!-- custom js -->
    <script src=" {{asset('js/front/custom.js')}}"></script>
        </body>
</html>

