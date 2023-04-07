<div>
    <div class="relative">
        <input type="text" class="w-full px-4 py-2 rounded" placeholder="Search posts..." wire:model.debounce.500ms="search">
        {{--        @if($search)--}}
        <button class="bg-white border-0" wire:click="$set('search', '')">
            <i class="fas fa-times text-gray-400 hover:text-gray-500"></i>
        </button>
        {{--        @endif--}}
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

<div>


</div>
