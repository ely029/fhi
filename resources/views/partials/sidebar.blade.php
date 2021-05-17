<div class="sidebar">
  <div class="sidebar__logo">
    <div class="sidebar__logo-wrapper"><img class="image" src="{{ asset('assets/app/img/logo.png') }}" alt="fhi Logo" /></div>
  </div>
    <div class="sidebar__container">
      <div class="sidebar__menu">
        <h3 class="sidebar__title">Reports</h3>
        <ul class="sidebar__list">
          <li class="sidebar__item">
            <a class="sidebar__link" href="{{ url('enrollments') }}">
              <div class="sidebar__wrapper">
                <img class="image" src="{{ asset('assets/app/img/icon-enrollment.png') }}" alt="Enrollment icon for fhi" />
                <img class="image image--white" src="{{ asset('assets/app/img/icon-enrollment-white.png') }}" alt="Enrollment icon on hover for fhi" />
              </div>
              <span class="sidebar__text">Enrollment</span>
            </a>
          </li>
          <li class="sidebar__item">
            <a class="sidebar__link" href="{{ url('case-management')}}">
              <div class="sidebar__wrapper">
                <img class="image" src="{{ asset('assets/app/img/icon-case-management.png') }}" alt="Case Management icon for fhi" />
                <img class="image image--white" src="{{ asset('assets/app/img/icon-case-management-white.png') }}" alt="Case management icon on hover for fhi" />
              </div>
              <span class="sidebar__text">Case Management</span>
            </a>
          </li>
          <li class="sidebar__item">
            @if(auth()->user()->role_id == 4)
            <a class="sidebar__link" href="{{ url('treatment-outcomes?status=New Case') }}">
            @elseif(auth()->user()->role_id == 5)
            <a class="sidebar__link" href="{{ url('treatment-outcomes?treatmentOutcomeTabs=all_cases') }}">
            @elseif(auth()->user()->role_id == 6)
            <a class="sidebar__link" href="{{ url('treatment-outcomes') }}">
            @elseif(auth()->user()->role_id == 7)
            <a class="sidebar__link" href="{{ url('treatment-outcomes?treatmentOutcomeTabs=all_cases_ntb') }}">
            @elseif(auth()->user()->role_id == 8)
            <a class="sidebar__link" href="{{ url('treatment-outcomes?treatmentOutcomeTabs=all_cases_ntb_chair') }}">
              @else
              <a class="sidebar__link" href="{{ url('treatment-outcomes') }}">
            @endif
              <div class="sidebar__wrapper">
                <img class="image" src="{{ asset('assets/app/img/icon-treatment.png') }}" alt="Treatment Outcome icon for fhi" />
                <img class="image image--white" src="{{ asset('assets/app/img/icon-treatment-white.png') }}" alt="Treatment Outcome icon on hover for fhi" />
              </div>
              <span class="sidebar__text">Treatment Outcome</span>
            </a>
          </li>
          <li class="sidebar__item">
            <a class="sidebar__link" href="masterlist.html">
              <div class="sidebar__wrapper">
                <img class="image" src="{{ asset('assets/app/img/icon-masterlist.png') }}" alt="Masterlist icon for fhi" />
                <img class="image image--white" src="{{ asset('assets/app/img/icon-masterlist-white.png') }}" alt="Masterlist icon on hover for fhi" />
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
                    <img class="image" src="{{ asset('assets/app/img/icon-meetings.png') }}" alt="Meetings icon for fhi" /><img class="image image--white" src="{{ asset('assets/app/img/icon-meetings-white.png') }}" alt="Meetings icon on hover for fhi" />
                </div>
                <span class="sidebar__text">Meetings</span>
                </a>
            </li> --}}
            @if(auth()->user()->id == 1)x
                <li class="sidebar__item {{ request()->is('dashboard/users*') ? 'active' : null }}">
                    <a class="sidebar__link" href="{{ url('dashboard/users') }}">
                    <div class="sidebar__wrapper">
                        <img class="image" src="{{ asset('assets/app/img/icon-role-management.png') }}" alt="role Management icon for fhi" />
                        <img class="image image--white" src="{{ asset('assets/app/img/icon-role-management-white.png') }}" alt="role management icon on hover for fhi" />
                    </div>
                    <span class="sidebar__text">Role Management</span>
                    </a>
                </li>
                <li class="sidebar__item {{ request()->is('') ? 'active' : null }}">
                    <a class="sidebar__link" href="{{ url('') }}">
                    <div class="sidebar__wrapper">
                        <img class="image" src="{{ asset('assets/app/img/icon-feedback.png') }}" alt="feedback Management icon for fhi" />
                        <img class="image image--white" src="{{ asset('assets/app/img/icon-feedback-white.png') }}" alt="feedback management icon on hover for fhi" />
                    </div>
                    <span class="sidebar__text">Feedback</span>
                    </a>
                </li>
            @endif
            {{-- <li class="sidebar__item">
                <a class="sidebar__link" href="activity-log.html">
                <div class="sidebar__wrapper">
                    <img class="image" src="{{ asset('assets/app/img/icon-activity-log.png') }}" alt="activity logs icon for fhi" /><img class="image image--white" src="{{ asset('assets/app/img/icon-activity-log-white.png') }}" alt="activity logs icon on hover for fhi" />
                </div>
                <span class="sidebar__text">Activity log</span>
                </a>
            </li> --}}
            </ul>
        @endif
      </div>
      <a class="sidebar__footer" href="">
        <div class="sidebar__footer-content">
          <h2 class="sidebar__footer-heading">{{ auth()->user()->name }}</h2>
          <span class="sidebar__footer-span">Role | Region</span>
        </div>
        <div class="arrow arrow--right"></div>
      </a>
    </div>
  </div>