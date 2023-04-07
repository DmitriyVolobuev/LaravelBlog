<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class SearchBar extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::where('title', 'like', '%'.$this->search.'%')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

//        $posts->onEachSide(1)->links('livewire.pagination')->setQueryString('search');

        return view('livewire.search-bar', compact('posts'));
    }
}

