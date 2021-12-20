<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('storage/public/logo/logo_small_icon_only.png') }}">
    <title>BoolBnB | Home</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script  src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps-web.min.js"></script> 
    <script  src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/services/services-web.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- Braintree  --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.32.1/js/dropin.min.js"></script>

    <!-- Styles -->
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps.css'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{-- nav bar custom --}}
        <section id="nav-header" class="position-sticky sticky-top">

            <nav class="navbar navbar-expand-lg navbar-dark black-nav justify-content-between">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="width:100px" src="{{ asset('storage/public/logo/logo_small_black.png') }}" 
                        alt="Logo b&b" title="Torna alla Home">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                        <div class="d-flex align-item-center pt-3 pt-lg-0">
    
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Esci') }}
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item ml-3" title="Vai al tuo profilo"><a href="{{route('user.apartments.index')}}"><i class="fas fa-user fa-2x"></i></a></li>
    
                        </div>
                        @endguest
                    </ul>
                </div>
            </nav>
        </section>
    
        <main class="mb-1">
            @yield('content')
        </main>
        <footer class="bg-dark text-center text-white">
            <!-- Grid container -->
            <div class="container p-4">
          
              <!-- Section: Social media -->
              <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
          
                <!-- Twitter -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>
          
                <!-- Google -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>
          
                <!-- Instagram -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>
          
                <!-- Linkedin -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                <!-- Github -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
              </section>
              <!-- Section: Social media -->
          
          
              <!-- Section: Form -->
              <section class="">
                <form action="">
                  <!--Grid row-->
                  <div class="row d-flex justify-content-center">
                    <!--Grid column-->
                    <div class="col-auto">
                      <p class="pt-2">
                        <strong>Iscriviti alla newsletter</strong>
                      </p>
                    </div>
                    <!--Grid column-->
          
                    <!--Grid column-->
                    <div class="col-md-5 col-12">
                      <!-- Email input -->
                      <div class="form-outline form-white mb-4">
                        <input type="email" id="form5Example2" class="form-control" />
                        <label class="form-label" for="form5Example2">Email address</label>
                      </div>
                    </div>
                    <!--Grid column-->
          
                    <!--Grid column-->
                    <div class="col-auto">
          
                      <!-- Submit button -->
                      <button type="submit" class="btn btn-outline-light mb-4">
                        Iscriviti
                      </button>
                    </div>
                    <!--Grid column-->
                  </div>
                  <!--Grid row-->
                </form>
              </section>
              <!-- Section: Form -->
          
          
              <!-- Section: Text -->
              <section class="mb-4">
                <p>
                  <q>Se vuoi qualcosa che non hai mai avuto, devi fare qualcosa che non hai mai fatto.</q>
                  <cite>Thomas Jefferson</cite>
                </p>
              </section>
              <!-- Section: Text -->
          
          
              <!-- Section: Links -->
              <section class="">
                <!--Grid row-->
                <div class="row justify-content-around">
                  <!--Grid column-->
                  <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links importanti</h5>
          
                    <ul class="list-unstyled mb-0">
                      <li>
                        <a href="https://policies.google.com/privacy?hl=it" class="text-white">Privacy policy</a>
                      </li>
                      <li>
                        <a href="https://privacy.italiaonline.it/common/cookie/privacy_detail.php" class="text-white">Cookies policy</a>
                      </li>
                      <li>
                        <a href="https://www.iubenda.com/it/help/1757-termini-e-condizioni-a-cosa-servono#:~:text=I%20Termini%20e%20Condizioni%2C%20cui,%2Fapp%20e%20l'utente." class="text-white">Termini e Condizioni</a>
                      </li>
                    </ul>
                  </div>
                  <!--Grid column-->
          
                  <!--Grid column-->
                  <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">I nostri contatti</h5>
          
                    <ul class="list-unstyled mb-0">
                      <li>
                        <a href="https://github.com/daviddpi" class="text-white">David Piscopo</a>
                      </li>
                      <li>
                        <a href="https://github.com/ManasseDettoMana" class="text-white">Manasse Smarrazzo</a>
                      </li>
                      <li>
                        <a href="https://github.com/VAB1998" class="text-white">Vincenzo Blanco</a>
                      </li>
                      <li>
                        <a href="https://github.com/FrancescoSica16" class="text-white">Francesco Sica</a>
                      </li>
                    </ul>
                  </div>
                  <!--Grid column-->
          
                </div>
                <!--Grid row-->
              </section>
              <!-- Section: Links -->
          
            </div>
            <!-- Grid container -->
          
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2020 Copyright:
                <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
          
        </footer>
        <!-- Footer -->
    </div>
    <script>
        const myNav = document.querySelector('.navbar');
        window.onscroll = function () { 
            "use strict";
            if (window.scrollY >= 665 ) {

                myNav.classList.add("white-nav");
                myNav.classList.add("navbar-light");

                myNav.classList.remove("navbar-dark");
                myNav.classList.remove("black-nav");
            } 
            else {
                myNav.classList.add("black-nav");
                myNav.classList.add("navbar-dark");

                myNav.classList.remove("white-nav");
                myNav.classList.remove("navbar-light");


            }
        };

    </script>
</body>
</html>
