<x-card>

    <x-card-header>

        <x-card-title>

            {{ __('Вход') }}

        </x-card-title>

        <x-slot name="right">

            <a href="{{ route('register') }}">{{ __('Регистрация') }}</a>

        </x-slot>

    </x-card-header>

    <x-card-body>

        <x-errors />

        <x-form action="{{ route('login.store') }}" method="POST">

            @csrf

            <x-form-item>

                <x-label  required>{{ __('Email') }}</x-label>

                <x-input type="email" name="email" autofocus />

            </x-form-item>

            <x-form-item>

                <x-label  required>{{ __('Пароль') }}</x-label>

                <x-input type="password" name="password" />

            </x-form-item>


            <x-form-item>

                <x-checkbox name="remember">

                    {{ __('Запомнить') }}

                </x-checkbox>

            </x-form-item>


            <x-button type="submit">

                {{ __('Войти') }}

            </x-button>

        </x-form>

        <div class="text-center pt-1">
            <h6>Если есть аккаунт зайдите с помощью</h6>
        </div>

        <div class="text-center">
            <a href="{{ route('login.google') }}" class="btn btn-google"><i class="bi bi-google" style="font-size: 2rem; color: cornflowerblue;"></i></a>
            <a href="{{ route('login.github') }}" class="btn btn-github"><i class="bi bi-github" style="font-size: 2rem; color: cornflowerblue;"></i></a>
        </div>

    </x-card-body>

</x-card>
