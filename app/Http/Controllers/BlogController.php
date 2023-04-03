<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(Request $request)
    {

        $data = $request->all();

        $search = $request->input('search');

        $category_id = $request->input('category_id');

//        dd($data);

        $post = (object) [
          'id' => 123,
          'title' => 'Тестовый заголовок поста',
          'content' => 'Тестовый контент поста',
          'category_id' => 1,
        ];

        $posts = array_fill(0, 10 , $post);

        $posts = array_filter($posts, function ($post) use ($search, $category_id) {
            if ($search && !str_contains(mb_convert_case($post->title, MB_CASE_LOWER), mb_convert_case($search, MB_CASE_LOWER))) {
                return false;
            }

            if ($category_id && $post->category_id != $category_id) {
                return false;
            }

            return true;
        });

        $categories = [null => __('Все категории'), 1 => __('Первая категория'), 2 => __('Вторая категория')];

//        dd($posts);

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
