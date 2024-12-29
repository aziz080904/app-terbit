<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to Terbit</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="App Landing Page" name="keywords">
        <meta content="App Landing Page" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400|Roboto:300&display=swap" rel="stylesheet"> 

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">

        <!-- Material Icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        

    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="51">
        <!-- Header Start-->
        <div id="header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="header-content">
                            <!-- Logo -->
                            <a class="logo" href=""><img src="{{ asset('frontend/assets/img/LOGO_TERBIT-removebg-preview.png') }}" alt="Logo"></a>
                            
                            <!-- Heading -->
                            <h2>Sistem Reminder<br>Bimbingan <span style="color: black;">TA</span></h2>
                            <p>Let's Get Started</p>
                            
                            <!-- Buttons -->
                            <a class="btn" href="{{route('login')}}">
                                <span class="material-icons" style="vertical-align: middle; margin-right: 5px;">login</span>
                                Login
                            </a>
                            <a class="btn" href="{{route('register')}}">
                                <span class="material-icons" style="vertical-align: middle; margin-right: 5px;">app_registration</span>
                                Register
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End--> 
       
        <!-- Footer Start -->
        <div id="footer">
            <div class="container">
                <div class="social">
                    <a href="https://www.instagram.com/7husky_lux/" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="copyright">
                    <p>&copy; Copyright 2024 by <a href="https://www.instagram.com/7husky_lux/">Husky</a>. All Rights Reserved</p>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
