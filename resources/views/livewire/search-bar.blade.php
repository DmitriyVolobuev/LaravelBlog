<div>

    <div class="row">

        <div class="col-12 col-md-4">

            <div class="mb-3">

                <div class="relative">
                    <input type="text" class="form-control" placeholder="Название поста" wire:model.debounce.500ms="search">
                    {{--        @if($search)--}}
{{--                    <button class="bg-white border-0" wire:click="$set('search', '')">--}}
{{--                        <i class="fas fa-times text-gray-400 hover:text-gray-500"></i>--}}
{{--                    </button>--}}
                    {{--        @endif--}}
                </div>

            </div>

        </div>

        <div class="col-12 col-md-4">

            <div class="mb-3">

                <select class="form-control" name="category_id" wire:model="selectedCategory">

                    <option value="">Все категории</option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

    </div>

        @if($posts->isEmpty())

            {{ __('Нет ни одного поста') }}

        @else

            <div class="row">

                    @if ($posts->count())

                        @foreach ($posts as $post)

                            <div class="col-12 col-md-4">

                                <x-post.card :post="$post" />

                            </div>

                        @endforeach

                    @else

                        <p>No posts found.</p>

                    @endif

            </div>

            <div class="mt-4">
                {{ $posts->links('livewire.livewire-pagination') }}
            </div>

        @endif

    </div>

