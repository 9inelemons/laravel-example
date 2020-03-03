<!--DOCTYPE html-->
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Личный кабинет</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">





  <style type="text/css">
  @media only screen and (max-width: 767px) {
    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 900000;
      padding: 0;
      top: 0;
      right: 0;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
    }
  }
  </style>
</head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('owner.index') }}">
          {{ Auth::user()->organization }}
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
      </a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                {{ __('Выход') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
      </ul>
      <i class="fas fa-bars float-right p-2 d-md-none text-white" id="openNav"><img src="https://icon-library.net//images/sidebar-icon/sidebar-icon-19.jpg" width="30" /></i>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-block bg-light sidebar sidenav" id="mySidenav">
          <i class="fas fa-times d-md-none" id="closeNav"><img src="https://icon-library.net//images/close-x-icon/close-x-icon-19.jpg" width="30" /></i>
          <div class="sidebar-sticky p-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <h6 class="d-flex justify-content-between align-items-center">
                        <a class="nav-link" href="{{ route('orders.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                            Заказы
                        </a>
                        <a class="d-flex align-items-center text-muted" href="{{ route('orders.new.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a>
                    </h6>
                </li>
              <li class="nav-item">
                  <h6 class="d-flex justify-content-between align-items-center">
                      <a class="nav-link" href="{{ route('owner.prices.index') }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                          Прайсы
                      </a>
                      <a class="d-flex align-items-center text-muted" href="{{ route('owner.prices.import.index') }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                      </a>
                  </h6>
              </li>
                <li class="nav-item">
                    <h6 class="d-flex justify-content-between align-items-center">
                        <a class="nav-link" href="{{ route('owner.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                            Личный кабинет
                        </a>
                    </h6>
                </li>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-0">
            @stack('scripts')
            @yield('content')
        </main>
      </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body></html>
