@extends('layouts.main')

@section('page.title', 'Блог')

@section('main.content')

    <x-title>

        {{ __('Список постов') }}

    </x-title>

    @include('blog.filter')

    <livewire:search-bar />

@endsection
