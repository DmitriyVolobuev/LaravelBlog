<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $test = '123';

        $post = (object) [
            'id' => 123,
            'title' => 'Тестовый заголовок поста',
            'content' => 'Тестовый контент поста',
        ];

        $posts = array_fill(0, 10 , $post);

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
            'content' => ['required', 'string'],
        ]);

        dd($validated);

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
