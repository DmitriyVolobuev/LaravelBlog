<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use Livewire\WithPagination;

class SearchBar extends Component
{
    use WithPagination;

    public $search = '';

    public $selectedCategory = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $validated = $this->validate([
            'search' => ['string'],
        ]);

        $categories = Category::all();

        $posts = Post::query()
            ->when($this->selectedCategory, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($validated['search'], function ($query, $searchTerm) {
                return $query->where('title', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('published_at', 'desc')
            ->paginate(12);

//        $posts->onEachSide(1)->links('livewire.pagination')->setQueryString('search');

        return view('livewire.search-bar', compact('posts', 'categories'));
    }

}

