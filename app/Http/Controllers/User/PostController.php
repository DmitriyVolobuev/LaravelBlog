<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::query()
            ->latest('published_at')
            ->oldest('id')
            ->paginate(12);

        return view('user.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store(Request $request)
    {

        $validated = validate($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:10000'],
            'published_at' => ['nullable', 'string', 'date'],
            'published' => ['nullable', 'boolean'],
        ]);

        $post = Post::query()->firstOrCreate([
            'user_id' => User::query()->value('id'),
            'title' => $validated['title'],
        ], [
            'content' => $validated['content'],
            'published_at' => new Carbon($validated['published_at'] ?? null),
            'published' => $validated['published'] ?? false,
        ]);

        dd($post->toArray());

        alert(__('Сохранено'));

        return redirect()->route('user.posts.show', 123);
    }

    public function show($post)
    {

        $post = (object) [
            'id' => 123,
            'title' => 'Тестовый заголовок поста',
            'content' => 'Тестовый контент поста',
        ];

        return view('user.posts.show', compact('post'));
    }

    public function edit($post)
    {

        $post = (object) [
            'id' => 123,
            'title' => 'Тестовый заголовок поста',
            'content' => 'Тестовый контент поста',
        ];

        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, $post)
    {

        $validated = validate($request->all(), Post::getRules());

        dd($validated);

        alert(__('Сохранено'));

        return redirect()->back();

    }

    public function delete($post)
    {

        return redirect()->route('user.posts');

    }

    public function like()
    {

    }

}
