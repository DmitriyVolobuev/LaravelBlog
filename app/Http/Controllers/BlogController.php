<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(Request $request)
    {

        $categories = [
            null => __('Все категории'),
            1 => __('Первая категория'),
            2 => __('Вторая категория')
        ];

        // select id, title, published_at from posts

        $posts = Post::all(['id', 'title', 'published_at']);

        $validated = $request->validate([
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $page = $validated['page'] ?? 1;

        $limit = $validated['limit'] ?? 12;

        $offset = $limit * ($page - 1);

        // select * from posts limit 12 offset 12

        $posts = Post::query()->limit($limit)->offset($offset)->get();

        $posts = Post::query()->paginate(12, ['id', 'title', 'published_at']);

        // select * from posts order by published_at desc

        $posts = Post::query()
            ->latest('published_at')
            ->oldest('id')
            ->paginate(12);

//        dd($validated);

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($post)
    {

        $post = (object) [
            'id' => 123,
            'title' => 'Тестовый заголовок поста',
            'content' => 'Тестовый контент поста',
        ];

        return view('blog.show', compact('post'));
    }

    public function like($post)
    {

    }
}
