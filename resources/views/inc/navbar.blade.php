<nav class="navbar navbar-expand-md navbar-light navbar-laravel "  >
    <div class="container" >
        <a class="navbar-brand" href="{{ url('/category') }}" >
            <img src="/d.png" alt="Smiley face" width="40" height="40">
        </a>
        <a class="navbar-brand" href="{{ url('/category') }}">
            {{ config('app.dec', 'DonzLang') }}
        </a>
        @auth
        <a class="navbar-brand" href="{{ url('/wordset') }}">
            Stwórz zestaw
        </a>
        @endauth
        <a class="navbar-brand" href="{{ url('/category') }}">
            Kategorie
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" >

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto" >
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown" >
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>


                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" >

                            {{--logout--}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                            {{--endLogout--}}

                            {{--admin--}}
                            @if(Auth::user()->role_id===4)
                                <a class="dropdown-item" href="{{ route('admin') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('admin').submit();">
                                    {{ __('Admin') }}
                                </a>
                                {{--@endif--}}
                                <form id="admin" action="{{ route('admin') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="{{ route('category.create') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('category.create').submit();">
                                    {{ __('Dodaj kategorie') }}
                                </a>
                                {{--@endif--}}
                                <form id="category.create" action="{{ route('category.create') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="{{ route('showCategories') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('showCategories').submit();">
                                    {{ __('Edytuj kategorie') }}
                                </a>
                                {{--@endif--}}
                                <form id="showCategories" action="{{ route('showCategories') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                            @endif
                            {{--endadmin--}}


                            {{--account--}}
                            <form id="account" action="{{ route('account') }}" method="GET" style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="{{ route('account') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('account').submit();">
                                {{ __('Konto') }}
                            </a>
                            {{--endaccount--}}

                            {{--utworz prywatny--}}
                            <form id="createPrivateSet" action="{{ route('createPrivateSet') }}" method="GET" style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="{{ route('createPrivateSet') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('createPrivateSet').submit();">
                                {{ __('Utwórz prywatny zestaw') }}
                            </a>
                            {{--endutworzprywatny--}}

                            {{--Towoje zestawy--}}
                            <form id="showPrivateSet" action="{{ route('showPrivateSet') }}" method="GET" style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="{{ route('showPrivateSet') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('showPrivateSet').submit();">
                                {{ __('Twoje zestawy') }}
                            </a>
                            {{--end twoje zestway--}}


                        </div>


                    </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>