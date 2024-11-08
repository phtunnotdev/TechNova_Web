<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostDetailController extends Controller
{
    //
    protected $classActive = "Bài viết";

    public function index()
    {
        $posts = Post::with('user')->get();
        $template = 'clients.blogs.blog';

        return view('clients.layout', [
            'title' => 'Danh Sách Bài Viết',
            'template' => $template,
            'classActive' => $this->classActive,
            'posts' => $posts
        ]);
    }
    public function blogDetail(string $slug)
    {

        $post = Post::with('user', 'comments')->where('slug', $slug)->first();
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Bài viết không tồn tại.');
        }

        $post->views = $post->views + 1;
        $post->save();

        $template = 'clients.blogs.blog-detail';

        return view('clients.layout', [
            'title' => 'Bài Viết Chi Tiết',
            'template' => $template,
            'classActive' => $this->classActive,
            'post' => $post,
            'author' => $post->user
        ]);
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($postId);

        // Tạo bình luận mới
        $post->comments()->create([
            'name' => $request->name,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('client.blog.detail', $postId)->with('success', 'Bình luận đã được gửi.');
    }
}
