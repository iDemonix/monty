<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ (\Request::route()->getName() == 'home') ? 'active' : '' }}" href="/home">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
             <li class="nav-item">
                <a class="nav-link {{ (\Request::route()->getName() == 'account') ? 'active' : '' }}" href="/account">
                  <span data-feather="user"></span>
                  My Account
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Queues</span>
              <a class="d-flex align-items-center text-muted" href="/queues/create">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              @foreach($queues as $queue)
              <li class="nav-item">
                <a class="nav-link {{ (\Request::path() == 'queue/' . $queue->id) ? 'active' : '' }}" href="/queue/{{$queue->id}}">
                  <span data-feather="layers"></span>
                  {{ $queue->name }}
                </a>
              </li>
              @endforeach
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Management</span>
            </h6>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ (\Request::route()->getName() == 'tags') ? 'active' : '' }}" href="#">
                  <span data-feather="tag"></span>
                  Tags
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ (\Request::route()->getName() == 'users') ? 'active' : '' }}" href="#">
                  <span data-feather="users"></span>
                  Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ (\Request::route()->getName() == 'settings') ? 'active' : '' }}" href="#">
                  <span data-feather="settings"></span>
                  Settings
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ (\Request::route()->getName() == 'reports') ? 'active' : '' }}" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Reports
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ (\Request::route()->getName() == 'integrations') ? 'active' : '' }}" href="#">
                  <span data-feather="layers"></span>
                  Plugins
                </a>
              </li>
            </ul>
          </div>
        </nav>