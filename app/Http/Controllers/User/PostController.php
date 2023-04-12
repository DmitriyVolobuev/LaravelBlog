<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        $posts = $user->posts()
            ->latest('published_at')
            ->oldest('id')
            ->paginate(12);

        return view('user.posts.index', compact('posts'));
    }

    public function create()
    {

        $categories = Category::all();

        return view('user.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $user = auth()->user()->id;

        $validated = validate($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:10000'],
            'published_at' => ['nullable', 'string', 'date'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'published' => ['nullable', 'boolean'],
        ]);

        $post = Post::where('title', $validated['title'])
            ->where('user_id', $user)
            ->first();

        if ($post) {
            return redirect()->back()->withInput()->withErrors(['title' => 'Пост с таким именем уже существует']);
        }

        $post = Post::query()->firstOrCreate([
            'user_id' => $user,
            'title' => $validated['title'],
        ], [
            'content' => $validated['content'],
            'published_at' => new Carbon($validated['published_at'] ?? null),
//            'category_id' => intval($validated['category_id']),
            'published' => $validated['published'] ?? false,
        ]);

        $post->category_id = intval($validated['category_id']);
        $post->save();

        alert(__('Сохранено'));

        return redirect()->route('user.posts.show', $post->id);
    }

    public function show($post)
    {

        $post = Post::query()
            ->where('id', $post)
            ->first();

        return view('user.posts.show', compact('post'));
    }

    public function edit($post)
    {

        $categories = Category::all();

        $post = Post::find($post);

        return view('user.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $post)
    {

        $validated = validate($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:10000'],
            'published_at' => ['nullable', 'string', 'date'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'published' => ['nullable', 'boolean'],
        ]);

        $post = Post::findOrFail($post);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => intval($validated['category_id']),
            'published_at' => new Carbon($validated['published_at'] ?? null),
            'published' => $validated['published'] ?? false,
        ]);

        alert(__('Сохранено'));

        return redirect()->route('user.posts.show', $post->id);

    }

    public function delete($post)
    {

        $post = Post::findOrFail($post);

        $post->delete();

        alert(__('Удален'));

        return redirect()->route('user.posts');

    }

    public function like()
    {

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
