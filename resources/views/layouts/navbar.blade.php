<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bookings</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                                    <a class="dropdown-item" href="">Today Bookings</a>
                                    <a class="dropdown-item" href="">Coming Bookings</a>
                                    <a class="dropdown-item" href="">Bookings History</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">liste des vehicule</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">liste des clients</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">liste des courses</a>
                                </li>   
                                <li class="nav-item">
                                    <a href="" class="nav-link">Reclamations</a>
                                </li> 
                            
                    </ul>
                    @endauth 
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                          <li class="nav-item">
                              <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                          </li>

                          <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                              </li>
                            </div>
                          </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

       