@extends('layouts.main')

@section('page.title', 'Создание поста')

@section('main.content')

    <x-title>

        {{ __('Создание поста') }}

        <x-slot name="link">

            <a href="{{ route('user.posts') }}">{{ __('Назад') }}</a>

        </x-slot>

    </x-title>

    <x-post.form action="{{ route('user.posts.store') }}" method="post" :categories="$categories">

        <x-button type="submit">

            {{ __('Создать пост') }}

        </x-button>

    </x-post.form>

@endsection
