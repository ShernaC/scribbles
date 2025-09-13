<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController
{
    public function showCreate ()
    {
        return view('post.create');
    }

    public function showUpdate (int $id)
    {
        $post = Post::findOrFail($id);

        // Gate::authorize('own-post', $post);
        $response = Gate::inspect('update', $post);
        if (!$response->allowed()) {
            return redirect()->route('post.getAll')->with('fail', $response->message());
        }

        return view('post.update', compact('post')); 
    }

    public function createPost(PostRequest $request) 
    {
        $validated = $request->validated();

        Post::create([
            'title' => $validated['title'], 
            'content' => $validated['content'],
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully'); 
    }

    public function getPost(string $id)
    {
        $id = (int) $id;
         
        $post = Post::where('user_id', Auth::user()->id)->findOrFail($id);

        return view('post.show', compact('post'));
    }

    public function getPostsByUserID()
    {
        $posts = Post::where('user_id', Auth::user()->id)->get();

        return view('post.index', compact('posts'));
    }

    public function getAllPosts()
    {
        $posts = Post::with('user')->get();
        
        if ($posts->count() > 0) {
            $posts = $posts->sortByDesc('created_at');
        }

        return view('post.browse', compact('posts'));
    }

    public function updatePost(Request $request, $id)
    {
        $id = (int) $id;
        $post = Post::find($id);


        $response = Gate::inspect('update', $post);
        if (!$response->allowed()) {
            return redirect()->home('home')->with('fail', $response->message());
        }

        if (!$post) {
            return redirect()->route('home')->with('fail', 'Failed to find post'); 
        }

        $validated = $request->validate([
            'content' => 'sometimes|required|string',
        ]);

        $post->update($validated);

        return redirect()->route('post.getAll')->with('success', 'Post updated successfully'); 
    }

    public function deletePost(int $id)
    {
        $post = Post::findOrFail($id);

        Gate::authorize('own-post', $post);

        if (!$post) {
            return redirect()->back()->with('failed', 'Failed to find post.'); 
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully'); 
    }
}
