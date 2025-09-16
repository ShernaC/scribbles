<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\uploadRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;

class PostController
{
    public function showCreate ()
    {
        return view('post.create');
    }

    public function showUpdate (int $id)
    {
        $post = Post::findOrFail($id);

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
            'image' => $request->uploaded_image_path,
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
        $posts = Post::with('user')->orderByDesc('created_at')->get();

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
            'content' => 'nullable|string',
        ]); 

        // dd(isset($validated['content']), empty($validated['content']));

        $post->update([
            'content' => $validated['content'] ?? '', // null coalescing operator
        ]); 

        if ($request->uploaded_image_path) {
            $post->update([
                'image' => $request->uploaded_image_path,
            ]);
        }

        return redirect()->route('post.getAll')->with('success', 'Post updated successfully'); 
    }

    public function deletePost(int $id)
    {
        $post = Post::findOrFail($id);

        Gate::authorize('own-post', $post);

        try {
            DB::beginTransaction();
            $post->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th); // log in system
            return redirect()->back()->with('fail', 'Post deletion failed'); 
        }

        return redirect()->back()->with('success', 'Post deleted successfully'); 
    }

    public function uploadPicture(uploadRequest $request)
    {
        Log::info('Ajax request received by controller');
        // ajax req hit sini
        if (!$request->hasFile('image')) {
            return response()->json([
                'success' => false,
                'message' => 'No file received',
            ], 400);
        }
        
        // validasi gambar 
        try {
            $validated = $request->validated();
            $image = $request->file('image');

            // simpan di local storage 
            $path = Storage::disk('public')->putFile('images', $image);

            return response()->json([
                'success' => true, 
                'message' => 'Image uplaoded successfully',
                'data' => [
                    'path' => $path,
                    'url' => asset('storage/' . $path),
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'file_name' => $request->file('image')?->getClientOriginalName(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Upload failed. Please try again.'
            ], 500);
        }
    }
}
