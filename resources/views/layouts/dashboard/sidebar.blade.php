  <div class="content-wrapper js-content-wrapper">
      <div class="dashboard -home-9 js-dashboard-home-9">
          <div class="dashboard__sidebar scroll-bar-1">
              <div class="sidebar -dashboard">
                  <div class="sidebar__item -is-active -dark-bg-dark-2">
                      <a href="
    @if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }}
    @elseif(auth()->user()->role === 'teacher')
        {{ route('teacher.dashboard') }}
    @else
        {{ route('student.dashboard') }} @endif
"
                          class=" d-flex items-center text-17 lh-1 fw-500 -dark-text-white">
                          <i class="text-20 icon-discovery mr-15"></i>
                          Dashboard
                      </a>

                  </div>

                  @if (auth()->user()->role === 'teacher')
                      <div class="sidebar__item">
                          <a href=" {{ route('teacher.manage.courses') }} "
                              class="control-dshb d-flex items-center text-17 lh-1 fw-500">
                              <i class="text-20 icon-play-button mr-15"></i>
                              Manage Courses
                          </a>
                      </div>
                  @endif
                  @if (auth()->user()->role === 'admin')
                      <div class="sidebar__item">
                          <a href="{{ route('admin.categories') }}"
                              class="control-dshb d-flex items-center text-17 lh-1 fw-500">
                              <i class="far fa-folder text-20 mr-15"></i>
                              Manage Categories
                          </a>
                      </div>
                  @endif
                  @if (auth()->user()->role === 'admin')
                      <div class="sidebar__item">
                          <a href="#" class="control-dshb d-flex items-center text-17 lh-1 fw-500">
                              <i class="far fa-user text-20 mr-15"></i>
                              Manage Users
                          </a>
                      </div>
                  @endif
                  @if (auth()->user()->role === 'admin')
                      <div class="sidebar__item">
                          <a href="{{ route('admin.view.applications') }}"
                              class="control-dshb d-flex items-center text-17 lh-1 fw-500">
                              <i class="far fa-file-alt text-20 mr-15"></i>
                              Review Applications
                          </a>
                      </div>
                  @endif
                  <div class="sidebar__item">
                      <a href="dshb-messages.html" class="control-dshb d-flex items-center text-17 lh-1 fw-500">
                          <i class="text-20 icon-message mr-15"></i>
                          Messages
                      </a>
                  </div>

                  @if (auth()->user()->role === 'admin')
                      <div class="sidebar__item">
                          <a href="{{ route('admin.courses') }}"
                              class="control-dshb d-flex items-center text-17 lh-1 fw-500">
                              <i class="text-20 icon-list mr-15"></i>
                              Create Course
                          </a>
                      </div>
                  @endif
                  @if (auth()->user()->role === 'teacher')
                      <div class="sidebar__item">
                          <a href="{{ route('teacher.category.view') }}"
                              class="control-dshb d-flex items-center text-17 lh-1 fw-500">
                              <i class="text-20 icon-list mr-15"></i>
                              Apply for Course
                          </a>
                      </div>
                  @endif
                  <div class="sidebar__item">
                      <a href="dshb-reviews.html" class="control-dshb d-flex items-center text-17 lh-1 fw-500">
                          <i class="text-20 icon-comment mr-15"></i>
                          Reviews
                      </a>
                  </div>

                  <div class="sidebar__item">
                      <a href="{{ route('profile') }}" class="control-dshb d-flex items-center text-17 lh-1 fw-500"
                          id="control">
                          <i class="text-20 icon-setting mr-15"></i>
                          Settings
                      </a>
                  </div>


                  <div class="sidebar__item">
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <button type="submit"
                              class="d-flex items-center text-17 lh-1 fw-500 bg-transparent border-0 p-0">
                              <i class="text-20 icon-power mr-15"></i>
                              Logout
                          </button>
                      </form>
                  </div>
              </div>
          </div>
