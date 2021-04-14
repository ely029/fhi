<div class="sidebar">
    <div class="sidebar__logo"></div>
    <div class="sidebar__container">
      <div class="sidebar__menu">
        <h3 class="sidebar__title">Reports</h3>
        <ul class="sidebar__list">
          <li class="sidebar__item">
            <a class="sidebar__link" href="{{ url('enrollments') }}">
              <div class="sidebar__wrapper">
                <img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Enrollment icon for fhi" />
                <img class="image image--white" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Enrollment icon on hover for fhi" />
              </div>
              <span class="sidebar__text">Enrollment</span>
            </a>
          </li>
          <li class="sidebar__item">
            <a class="sidebar__link" href="case-management.html">
              <div class="sidebar__wrapper">
                <img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Case Management icon for fhi" />
                <img class="image image--white" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Case management icon on hover for fhi" />
              </div>
              <span class="sidebar__text">Case Management</span>
            </a>
          </li>
          <li class="sidebar__item">
            <a class="sidebar__link" href="treatment.html">
              <div class="sidebar__wrapper">
                <img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Treatment Outcome icon for fhi" />
                <img class="image image--white" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Treatment Outcome icon on hover for fhi" />
              </div>
              <span class="sidebar__text">Treatment Outcome</span>
            </a>
          </li>
          <li class="sidebar__item">
            <a class="sidebar__link" href="masterlist.html">
              <div class="sidebar__wrapper">
                <img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Masterlist icon for fhi" />
                <img class="image image--white" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Masterlist icon on hover for fhi" />
              </div>
              <span class="sidebar__text">Masterlist</span>
            </a>
          </li>
        </ul>
        @if(auth()->user()->id == 1 || auth()->user()->id == 2)
            <h3 class="sidebar__title">Administrative</h3>
            <ul class="sidebar__list">
            {{-- <li class="sidebar__item">
                <a class="sidebar__link" href="meetings.html">
                <div class="sidebar__wrapper">
                    <img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Meetings icon for fhi" /><img class="image image--white" src="src/img/icon-meetings-white.png" alt="Meetings icon on hover for fhi" />
                </div>
                <span class="sidebar__text">Meetings</span>
                </a>
            </li> --}}
            @if(auth()->user()->id == 1)
                <li class="sidebar__item {{ request()->is('dashboard/users*') ? 'active' : null }}">
                    <a class="sidebar__link" href="{{ url('dashboard/users') }}">
                    <div class="sidebar__wrapper">
                        <img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="User Management icon for fhi" />
                        <img class="image image--white" src="{{ asset('assets/app/img/icon-email.png') }}" alt="User management icon on hover for fhi" />
                    </div>
                    <span class="sidebar__text">Admin Management</span>
                    </a>
                </li>
            @endif
            {{-- <li class="sidebar__item">
                <a class="sidebar__link" href="user-log.html">
                <div class="sidebar__wrapper">
                    <img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="User logs icon for fhi" /><img class="image image--white" src="src/img/icon-user-log-white.png" alt="User logs icon on hover for fhi" />
                </div>
                <span class="sidebar__text">User log</span>
                </a>
            </li> --}}
            </ul>
        @endif
      </div>
      <a class="sidebar__footer" id="navbarDropdown" data-toggle="dropdown">
        <div class="sidebar__footer-content">
          <h2 class="sidebar__footer-heading">My Account</h2>
          <span class="sidebar__footer-span">Role | Region</span>
        </div>
        <div class="arrow arrow--right">
            
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item logout-button" href="#">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
    </div>
    </div>
  </div>