@extends('layouts.base')

@section('content')

    <section>

        <x-container>

            <div class="row">

                <div class="col-8 сol-md-6 offset-md-2 pt-5">

                    @yield('auth.content')

                </div>

            </div>

        </x-container>

    </section>

@endsection
