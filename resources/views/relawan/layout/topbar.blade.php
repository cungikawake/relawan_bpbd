<!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i> Menu</a></li>
            </ul>
            <ul class="nav navbar-nav float-right">
              <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             
                  <span class="avatar avatar-online"><img src="/images/user.jpg" alt="avatar"><i></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="arrow_box_right">
                      <a class="dropdown-item" href="#">
                        <span class="avatar avatar-online">
                          <img src="/images/user.jpg" alt="avatar">
                          <span class="user-name text-bold-700 ml-1 text-truncate">{{ucfirst(Auth::user()->name)}}</span>
                        </span>
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ route('relawan.profile') }}">
                        <i class="ft-user"></i> Profile
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ft-power"></i> Logout
                      </a>
                      
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>