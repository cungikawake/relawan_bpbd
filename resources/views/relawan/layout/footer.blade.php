

    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
      <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2020  &copy; Copyright <a class="text-bold-800 grey darken-2" href="#" target="_blank">E-Relawan</a></span> 
      </div>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('theme-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('theme-assets/vendors/js/charts/chartist.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN CHAMELEON  JS-->
    <script src="{{ asset('theme-assets/js/core/app-menu-lite.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme-assets/js/core/app-lite.js') }}" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('theme-assets/js/scripts/pages/dashboard-lite.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- CUSTOM JS--> 
    @yield('script')
    @stack('script')

  </body>
</html>