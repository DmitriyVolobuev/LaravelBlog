@props(['post' => null, 'categories' => null])

<x-form {{ $attributes }}>

    <x-form-item>

        <x-label required>{{ __('Название поста') }}</x-label>

        <x-input name="title" value="{{ $post->title ?? '' }}" autofocus />

        <x-error name="title" />

    </x-form-item>


    <x-form-item>

        <x-label required>{{ __('Содержание поста') }}</x-label>

        <x-trix name="content" value="{{ $post->content ?? '' }}" />

        <x-error name="content" />

    </x-form-item>


    <x-form-item>

        <x-label required>{{ __('Дата публикации') }}</x-label>

        <x-input name="published_at" placeholder="dd.mm.yyyy" />

        <x-error name="published_at" />

    </x-form-item>


    <x-form-item>

        <x-label required>{{ __('Выберите категорию') }}</x-label>

        <select name="category_id" class="form-control" name="category_id" wire:model="selectedCategory">

            <option value="">Все категории</option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

    </x-form-item>


    <x-form-item>

        <x-checkbox name="published">

            {{ __('Опубликовано') }}

        </x-checkbox>

    </x-form-item>

    {{ $slot }}

</x-form>


