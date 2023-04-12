@extends('layouts.main')

@section('page.title', 'Мои донаты')

@section('main.content')

    <x-title>

        {{ __('Мои донаты') }}

        <x-slot name="link">

            <a href="{{ route('user.posts') }}">{{ __('Назад') }}</a>

        </x-slot>

    </x-title>

{{--    @include('user.donates.filter')--}}

    @include('user.donates.stats')

{{--    @include('user.donates.table')--}}

@endsection
