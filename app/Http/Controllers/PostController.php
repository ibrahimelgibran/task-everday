<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Simpan data baru
        Post::create($request->all());

        return redirect()->route('posts.index')
                         ->with('success','Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Validasi data input
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Update data
        $post->update($request->all());

        return redirect()->route('posts.index')
                         ->with('success','Post updated successfully');
    }

    public function destroy(Post $post)
    {
        // Hapus data
        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success','Post deleted successfully');
    }
}