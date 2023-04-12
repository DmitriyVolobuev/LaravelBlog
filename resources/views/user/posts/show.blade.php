@extends('layouts.main')

@section('page.title', 'Просмотр поста')

@section('main.content')

    <x-title>

        {{ __('Просмотр поста') }}

        <x-slot name="link">

            <a href="{{ route('user.posts') }}">{{ __('Назад') }}</a>

        </x-slot>

        <x-slot name="right">

            <form class="pb-3" action="{{ route('user.posts.delete', $post->id) }}" method="POST">

                @csrf
                @method('DELETE')

                <x-button type="submit">

                    {{ __('Удалить') }}

                </x-button>

            </form>

            <x-button-link href="{{ route('user.posts.edit', $post->id) }}">

                {{ __('Изменить') }}

            </x-button-link>

        </x-slot>

    </x-title>

    <h2 class="h4">

        {{ $post->title }}

    </h2>

    <div class="small text-muted">

        {{ $post->published_at?->format('d.m.Y H:i:s') }}

    </div>

    <div class="pt-3">

        {!! $post->content !!}

    </div>

@endsection
