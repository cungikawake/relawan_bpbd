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
            <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
                <a href="{{route('dashboard')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
            </li> 
            
            {{-- <li class=" nav-item {{ (request()->is('dashboard/induk-organisasi*')) ? 'active' : '' }}">
                <a href="{{route('dashboard.induk_organisasi.index')}}"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Induk Organisasi</span></a> 
            </li>
            <li class=" nav-item {{ (request()->is('dashboard/skill*')) ? 'active' : '' }}">
                <a href="{{route('dashboard.skill.index')}}"><i class="la la-graduation-cap"></i><span class="menu-title" data-i18n="">Skill</span></a>
            </li>
            <li class=" nav-item {{ (request()->is('dashboard/persyaratan*')) ? 'active' : '' }}">
                <a href="{{route('dashboard.persyaratan.index')}}"><i class="la la-keyboard-o"></i><span class="menu-title" data-i18n="">Persyaratan</span></a>
            </li>
            <li class=" nav-item {{ (request()->is('dashboard/bencana*')) ? 'active' : '' }}">
                <a href="{{route('dashboard.bencana.index')}}"><i class="la la-map"></i><span class="menu-title" data-i18n="">Bencana</span></a>
            </li> --}}

            <li class=" nav-item has-sub {{ (request()->is('dashboard/induk-organisasi*')) || (request()->is('dashboard/skill*')) || (request()->is('dashboard/persyaratan*'))   ? 'open' : '' }}"><a href="#"><i class="la la-keyboard-o"></i><span class="menu-title" data-i18n="">Master Data</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->is('dashboard/user*')) ? 'active' : '' }}">
                        <a href="{{route('dashboard.user.index')}}"><span class="menu-item" data-i18n="">User</span></a>
                    </li>

                    <li class="{{ (request()->is('dashboard/induk-organisasi*')) ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('dashboard.induk_organisasi.index')}}">Induk Organisasi</a>
                    </li>
                    <li class="{{ (request()->is('dashboard/skill*')) ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('dashboard.skill.index')}}">Skill</a>
                    </li>
                    <li class="{{ (request()->is('dashboard/persyaratan*')) ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('dashboard.persyaratan.index')}}">Persyaratan</a>
                    </li>
                    <li class="{{ (request()->is('dashboard/kategori*')) ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('dashboard.kategori.index')}}">Kategori Bencana</a>
                    </li> 
                </ul>
            </li>
            <li class=" nav-item has-sub {{ (request()->is('dashboard/bencana*')) || (request()->is('dashboard/list-kegiatan*'))  ? 'open' : '' }}"><a href="#"><i class="la la-support"></i><span class="menu-title" data-i18n="">Kegiatan</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->is('dashboard/bencana*')) ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('dashboard.bencana.index')}}"><i class="la la-puzzle-piece"></i><span class="menu-title" data-i18n=""> Master Kegiatan</a>
                    </li>
                    <li class=" nav-item {{ (request()->is('dashboard/list-kegiatan*')) ? 'active' : '' }}">
                        <a href="{{route('dashboard.list_kegiatan.index')}}"><i class="la la-map"></i><span class="menu-title" data-i18n=""> Pantau Kegiatan</span></a>
                    </li> 
                </ul>
            </li>
            <li class=" nav-item {{ (request()->is('dashboard/relawan*')) ? 'active' : '' }}">
                <a href="{{route('dashboard.relawan.index')}}"><i class="la la-male"></i><span class="menu-title" data-i18n="">Relawan</span></a>
            </li>
            
            <!-- <li class=" nav-item {{ (request()->is('dashboard/relawan*')) ? 'active' : '' }}">
                <a href="{{route('dashboard.relawan.index')}}"><i class="la la-compass"></i><span class="menu-title" data-i18n="">Evaluasi</span></a>
            </li> -->
            <li class=" nav-item {{ (request()->is('dashboard/relawan*')) ? '' : '' }}">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ft-power"></i> Logout</a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <div class="navigation-background"></div>
</div>