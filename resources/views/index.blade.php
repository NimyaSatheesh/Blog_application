<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
     
    </head>
    <body class="antialiased">
       <!-- !PAGE CONTENT! -->
        <div class="w3-content" style="max-width:1500px">

            <!-- Header -->
            <header class="w3-container w3-xlarge w3-padding-24">
            <a href="#" class="w3-left w3-button w3-white">MY BLOG</a>
            <a href="{{ route('admin.login') }}" class="w3-right w3-button w3-white">Login</a>
            </header>
        
            <!-- Photo Grid -->
            <div class="w3-row">
            <div class="w3-half">
                <img src="{{ asset('assets/images/streetart.jpg') }}" style="width:100%">
                <img src="{{ asset('assets/images/streetart2.jpg') }}" style="width:100%">
                <img src="{{ asset('assets/images/streetart5.jpg') }}" style="width:100%">
            </div>
        
            <div class="w3-half">
                <img src="{{ asset('assets/images/streetart3.jpg') }}" style="width:100%">
                <img src="{{ asset('assets/images/streetart4.jpg') }}" style="width:100%">
            </div>
            </div>
            
        <!-- End Page Content -->
        </div>
  
    </body>
</html>
