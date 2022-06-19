<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-bottom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-hospital-user fa-lg"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                @if (auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'pendaftaran')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pendaftaran/create') ? 'active' : '' }}"
                            href="{{ route('pendaftaran.create') }}">Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pendaftaran') ? 'active' : '' }}"
                            href="{{ route('pendaftaran.index') }}">Kunjungan</a>
                    </li>
                @endif
                @if (auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'poli')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('kunjungan/periksa/*') ? 'active' : '' }}"
                            href="{{ route('kunjungan.index') }}">Periksa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('kunjungan/rekammedis') ? 'active' : '' }}"
                            href="{{ route('rekammedis.index') }}">Rekam
                            Medis</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Kunjungan</a>
                    </li> --}}
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link {{ Request::is('admin/*') ? 'active' : '' }} {{ Request::is('profile/*') ? 'active' : '' }} dropdown-toggle"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Setting
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if (auth()->user()->role->name == 'admin')
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">User</a></li>
                            <li><a class="dropdown-item" href="{{ route('roles.index') }}">Role</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('profile', auth()->user()->id) }}">Profil</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
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
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


{{-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="#">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Dropdown
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </li>
  </ul> --}}
