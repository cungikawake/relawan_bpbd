

    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
      <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2020  &copy; Copyright <a class="text-bold-800 grey darken-2" href="https://erelawan.baliprove.go.id" target="_blank">e-Relawan</a></span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
          <li class="list-inline-item"><a class="my-1" href="#" target="_blank"> Pedoman</a></li>
          <li class="list-inline-item"><a class="my-1" href="#" target="_blank"> Panduan</a></li>
           
        </ul>
      </div>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('theme-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- <script src="{{ asset('theme-assets/vendors/js/charts/chartist.min.js') }}" type="text/javascript"></script> -->
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN CHAMELEON  JS-->
    <script src="{{ asset('theme-assets/js/core/app-menu-lite.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme-assets/js/core/app-lite.js') }}" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- <script src="{{ asset('theme-assets/js/scripts/pages/dashboard-lite.js') }}" type="text/javascript"></script> -->
    <!-- END PAGE LEVEL JS-->

    <!-- CUSTOM JS--> 
    @stack('script')

  </body>
</html>