<nav class="navbar navbar-expand-md navbar-light bg-light">

    <div class="container">

        <a href="{{ route('home') }}" class="navbar-brand">{{ config('app.name') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

                <li class="nav-item">
                    <a class="nav-link {{ active_link('home') }}" aria-current="page" href="{{ route('home') }}">{{ __('Главная') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ active_link('blog*') }}" aria-current="page" href="{{ route('blog') }}">{{ __('Блог') }}</a>
                </li>

            </ul>

            @auth()

                <ul class="navbar-nav ms-auto mb-2 mb-md-0">

                    <li class="nav-item">
                        <a href="{{ route('user.profile') }}" class="nav-link {{ active_link('user.profile') }}" aria-current="page">{{ __('Профиль') }}</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user.donates') }}" class="nav-link {{ active_link('user.donates') }}" aria-current="page">{{ __('Статистика') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('user.logout') }}">{{ __('Выход') }}</a>
                    </li>

                </ul>

            @else

            <ul class="navbar-nav ms-auto mb-2 mb-md-0">

                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ active_link('register') }}" aria-current="page">{{ __('Регистрация') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ active_link('login') }}" aria-current="page" href="{{ route('login') }}">{{ __('Вход') }}</a>
                </li>

            </ul>

            @endauth

        </div>
    </div>
</nav>
