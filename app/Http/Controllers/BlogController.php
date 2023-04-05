<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(Request $request)
    {

        $validated = $request->validate([

            'search' => ['nullable', 'string', 'max:50'],
            'from_date' => ['nullable', 'string', 'date'],
            'to_date' => ['nullable', 'string', 'date', 'after:from_date'],
            'tag' => ['nullable', 'string', 'max:10'],

        ]);

        // select * from posts order by published_at desc

        $query = Post::query()
            ->where('published', true)
            ->whereNotNull('published_at');

        if ($search = $validated['search'] ?? null) {

            $query->where('title', 'like', "%{$search}%");

        }

        if ($fromDate = $validated['from_date'] ?? null) {

            $query->where('published_at', '>=', new Carbon($fromDate));

        }

        if ($toDate = $validated['to_date'] ?? null) {

            $query->where('published_at', '<=', new Carbon($toDate));

        }

        if ($tag = $validated['tag'] ?? null) {

            $query->whereJsonContains('tags', $tag);

        }

            $posts = $query->latest('published_at')
            ->oldest('id')
            ->paginate(12);

        return view('blog.index', compact('posts', ));

    }

    public function show(Request $request,Post $post)
    {

        return view('blog.show', compact('post'));

    }

    public function like($post)
    {

    }
}
