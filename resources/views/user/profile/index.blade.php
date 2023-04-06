@extends('layouts.main')

@section('page.title', 'Мой профиль')

@section('main.content')

    <x-title>

        {{ __('Мой профиль') }}

        <x-slot name="link">

            <a href="{{ route('user.posts') }}">{{ __('Назад') }}</a>

        </x-slot>

    </x-title>

    Имя {{ auth()->user()->name }}

    {{--    @include('user.donates.filter')--}}

{{--    @include('user.donates.stats')--}}

    {{--    @include('user.donates.table')--}}

@endsection
