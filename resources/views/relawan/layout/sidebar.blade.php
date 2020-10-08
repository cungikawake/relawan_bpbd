    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="/theme-assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="Chameleon admin logo" src="/theme-assets/images/logo/logo.png"/>
              <h3 class="brand-text">E-Relawan</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="nav-item {{ (request()->is('relawan.dashboard')) ? 'active' : '' }}"><a href="{{route('relawan.dashboard')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>   
          <li class="nav-item {{ (request()->is('relawan.profile')) ? 'active' : '' }}"><a href="{{route('relawan.profile')}}"><i class="ft-user"></i><span class="menu-title" data-i18n="">Profile</span></a>
          </li>
          <li class="nav-item {{ (request()->is('relawan.bencana')) ? 'active' : '' }}"><a href="{{route('relawan.bencana')}}"><i class="ft-map-pin"></i><span class="menu-title" data-i18n="">Kegiatan Anda</span></a>
          </li>  
          <!-- <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}"><a href="{{route('dashboard')}}"><i class="ft-file"></i><span class="menu-title" data-i18n="">Tugas</span></a>
          </li> -->
          <li class="nav-item {{ (request()->is('bantuan')) ? 'active' : '' }}"><a href="{{route('bantuan')}}"><i class="ft-phone-forwarded"></i><span class="menu-title" data-i18n="">Bantuan</span></a>
          </li> 
        </ul> 
      </div>
      <div class="navigation-background"></div>
    </div>