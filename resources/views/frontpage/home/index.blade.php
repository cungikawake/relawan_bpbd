@extends('frontpage.layout.app')

@section('title', 'E-Relawan')

@section('content') 
<!-- ======= Slider Section ======= -->
<div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="{{ asset('frontpage/assets/img/slider/slider1.jpg') }}" alt="" title="#slider-direction-1" />
        <img src="{{ asset('frontpage/assets/img/slider/slider2.jpg') }}" alt="" title="#slider-direction-2" />
        <img src="{{ asset('frontpage/assets/img/slider/slider3.jpg') }}" alt="" title="#slider-direction-3" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Relawan Penanggulangan Bencana</h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Meningkatkan kapasitas relawan agar dapat bekerja dengan terkoordinasi, efektif dan efisien</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">Jadi Relawan</a>
                  <a class="ready-btn page-scroll" href="#about">Download App</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1"></h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Peran serta relawan dalam kegiatan
penanggulangan bencana</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">Jadi Relawan</a>
                  <a class="ready-btn page-scroll" href="#about">Download App</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1"></h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Meningkatkan kinerja serta daya dan hasil guna kegiatan relawan</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">Jadi Relawan</a>
                  <a class="ready-btn page-scroll" href="#about">Download App</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Slider -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Tentang e-Relawan</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- single-well start-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-left">
              <div class="single-well">
                <a href="#">
                  <img src="{{ asset('frontpage/assets/img/about/1.jpg') }}" alt="">
                </a>
              </div>
            </div>
          </div>
          <!-- single-well end-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-middle">
              <div class="single-well">
                <a href="#">
                  <h4 class="sec-head">Peran Relawan</h4>
                </a>
                <p>
                Relawan Penanggulangan Bencana, yang selanjutnya disebut relawan,
adalah seorang atau sekelompok orang yang memiliki kemampuan dan
kepedulian untuk bekerja secara sukarela dan ikhlas dalam upaya
penanggulangan bencana.
                </p>
                <ul>
                  <li>
                    <i class="fa fa-check"></i> Cepat dan tepat
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Prioritas
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Koordinasi
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Berdaya guna dan berhasil guna
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Transparansi
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Non-diskriminasi
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- End col-->
        </div>
      </div>
    </div><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <div id="services" class="services-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline services-head text-center">
              <h2>Kewajiban Relawan</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <!-- Start Left services -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="fa fa-code"></i>
                  </a>
                  <h4></h4>
                  <p>
                  Mentaati peraturan dan prosedur kebencanaan yang berlaku
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="fa fa-camera-retro"></i>
                  </a>
                  <h4></h4>
                  <p>
                  Menjunjung tinggi asas, prinsip dan panca darma relawan
penanggulangan bencana.
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- end col-md-4 -->
            <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="fa fa-wordpress"></i>
                  </a>
                  <h4></h4>
                  <p>
                  Meningkatkan pengetahuan, keterampilan dan kemampuannya dalam
penanggulangan bencana
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Services Section -->

    <!-- ======= Services Section ======= -->
    <div id="services" class="services-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline services-head text-center">
              <h2>Hak Relawan</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <!-- Start Left services -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="fa fa-code"></i>
                  </a>
                  <h4></h4>
                  <p>
                  Memperoleh pengakuan dan tanda pengenal relawan penanggulangan
bencana
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="fa fa-camera-retro"></i>
                  </a>
                  <h4></h4>
                  <p>
                  Mendapatkan peningkatan kapasitas yang berhubungan dengan
penanggulangan bencana
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- end col-md-4 -->
            <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    <i class="fa fa-wordpress"></i>
                  </a>
                  <h4></h4>
                  <p>
                  Mendapatkan perlindungan hukum dalam pelaksanaan tugas
penanggulangan bencana
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Services Section -->

    <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area">
      <div class="blog-inner area-padding">
        <div class="blog-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Bencana Terupdate</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start Left Blog -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="blog.html">
                    <img src="{{ asset('frontpage/assets/img/blog/1.jpg') }}" alt="">
                  </a>
                </div>
                <div class="blog-meta">
                  <span class="comments-type">
                    <i class="fa fa-comment-o"></i>
                    <a href="#">13 comments</a>
                  </span>
                  <span class="date-type">
                    <i class="fa fa-calendar"></i>2016-03-05 / 09:10:16
                  </span>
                </div>
                <div class="blog-text">
                  <h4>
                    <a href="blog.html">Assumenda repud eum veniam</a>
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                  </p>
                </div>
                <span>
                  <a href="blog.html" class="ready-btn">Read more</a>
                </span>
              </div>
              <!-- Start single blog -->
            </div>
            <!-- End Left Blog-->
            <!-- Start Left Blog -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="blog.html">
                    <img src="{{ asset('frontpage/assets/img/blog/2.jpg') }}" alt="">
                  </a>
                </div>
                <div class="blog-meta">
                  <span class="comments-type">
                    <i class="fa fa-comment-o"></i>
                    <a href="#">130 comments</a>
                  </span>
                  <span class="date-type">
                    <i class="fa fa-calendar"></i>2016-03-05 / 09:10:16
                  </span>
                </div>
                <div class="blog-text">
                  <h4>
                    <a href="blog.html">Explicabo magnam quibusdam.</a>
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                  </p>
                </div>
                <span>
                  <a href="blog.html" class="ready-btn">Read more</a>
                </span>
              </div>
              <!-- Start single blog -->
            </div>
            <!-- End Left Blog-->
            <!-- Start Right Blog-->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="blog.html">
                    <img src="{{ asset('frontpage/assets/img/blog/3.jpg') }}" alt="">
                  </a>
                </div>
                <div class="blog-meta">
                  <span class="comments-type">
                    <i class="fa fa-comment-o"></i>
                    <a href="#">10 comments</a>
                  </span>
                  <span class="date-type">
                    <i class="fa fa-calendar"></i>2016-03-05 / 09:10:16
                  </span>
                </div>
                <div class="blog-text">
                  <h4>
                    <a href="blog.html">Lorem ipsum dolor sit amet</a>
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                  </p>
                </div>
                <span>
                  <a href="blog.html" class="ready-btn">Read more</a>
                </span>
              </div>
            </div>
            <!-- End Right Blog-->
          </div>
        </div>
      </div>
    </div><!-- End Blog Section -->  
    <!-- ======= Rviews Section ======= -->
    <div class="reviews-area hidden-xs">
      <div class="work-us">
        <div class="work-left-text">
          <a href="#">
            <img src="{{ asset('frontpage/assets/img/about/2.jpg') }}" alt="">
          </a>
        </div>
        <div class="work-right-text text-center">
          <h2>Peran Relawan pada Saat Tanggap Darurat</h2>
          <h5>Kaji cepat terhadap cakupan wilayah yang terkena, jumlah korban dan
kerusakan, kebutuhan sumber daya, ketersediaan sumber daya serta
prediksi perkembangan situasi ke depan</h5>
          <a href="#contact" class="ready-btn scrollto">Jadi Relawan</a>
        </div>
      </div>
    </div><!-- End Rviews Section -->

     
    <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area">
      <div class="blog-inner area-padding">
        <div class="blog-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Berita Terupdate</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start Left Blog -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="blog.html">
                    <img src="{{ asset('frontpage/assets/img/blog/1.jpg') }}" alt="">
                  </a>
                </div>
                <div class="blog-meta">
                  <span class="comments-type">
                    <i class="fa fa-comment-o"></i>
                    <a href="#">13 comments</a>
                  </span>
                  <span class="date-type">
                    <i class="fa fa-calendar"></i>2016-03-05 / 09:10:16
                  </span>
                </div>
                <div class="blog-text">
                  <h4>
                    <a href="blog.html">Assumenda repud eum veniam</a>
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                  </p>
                </div>
                <span>
                  <a href="blog.html" class="ready-btn">Read more</a>
                </span>
              </div>
              <!-- Start single blog -->
            </div>
            <!-- End Left Blog-->
            <!-- Start Left Blog -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="blog.html">
                    <img src="{{ asset('frontpage/assets/img/blog/2.jpg') }}" alt="">
                  </a>
                </div>
                <div class="blog-meta">
                  <span class="comments-type">
                    <i class="fa fa-comment-o"></i>
                    <a href="#">130 comments</a>
                  </span>
                  <span class="date-type">
                    <i class="fa fa-calendar"></i>2016-03-05 / 09:10:16
                  </span>
                </div>
                <div class="blog-text">
                  <h4>
                    <a href="blog.html">Explicabo magnam quibusdam.</a>
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                  </p>
                </div>
                <span>
                  <a href="blog.html" class="ready-btn">Read more</a>
                </span>
              </div>
              <!-- Start single blog -->
            </div>
            <!-- End Left Blog-->
            <!-- Start Right Blog-->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="blog.html">
                    <img src="{{ asset('frontpage/assets/img/blog/3.jpg') }}" alt="">
                  </a>
                </div>
                <div class="blog-meta">
                  <span class="comments-type">
                    <i class="fa fa-comment-o"></i>
                    <a href="#">10 comments</a>
                  </span>
                  <span class="date-type">
                    <i class="fa fa-calendar"></i>2016-03-05 / 09:10:16
                  </span>
                </div>
                <div class="blog-text">
                  <h4>
                    <a href="blog.html">Lorem ipsum dolor sit amet</a>
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                  </p>
                </div>
                <span>
                  <a href="blog.html" class="ready-btn">Read more</a>
                </span>
              </div>
            </div>
            <!-- End Right Blog-->
          </div>
        </div>
      </div>
    </div><!-- End Blog Section -->

    <!-- ======= Suscribe Section ======= -->
    <div class="suscribe-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs=12">
            <div class="suscribe-text text-center">
              <h3>Welcome to our eBusiness company</h3>
              <a class="sus-btn" href="#">Get A quate</a>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Suscribe Section -->

    <!-- ======= Contact Section ======= -->
    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Contact us</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-mobile"></i>
                  <p>
                    Call: +1 5589 55488 55<br>
                    <span>Monday-Friday (9am-5pm)</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-envelope-o"></i>
                  <p>
                    Email: info@example.com<br>
                    <span>Web: www.example.com</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-map-marker"></i>
                  <p>
                    Location: A108 Adam Street<br>
                    <span>NY 535022, USA</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <!-- Start Google Map -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <!-- Start Map -->
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
              <!-- End Map -->
            </div>
            <!-- End Google Map -->

            <!-- Start  contact -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form contact-form">
                <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                    <div class="validate"></div>
                  </div>
                  <div class="mb-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>
                  <div class="text-center"><button type="submit">Send Message</button></div>
                </form>
              </div>
            </div>
            <!-- End Left contact -->
          </div>
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->
@stop