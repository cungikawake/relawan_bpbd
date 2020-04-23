<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="{{ route('home') }}"><span>e</span>Relawan</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{ route('home') }}">Home</a></li> 
          <li><a href="{{ route('bencana') }}">Bencana</a></li>  
          <li><a href="/#contact">Kontak</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a class="ready-btn" href="{{ route('register') }}" style="margin-top:0px;">Jadi Relawan</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->