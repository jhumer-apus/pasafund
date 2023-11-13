<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request, $type) {

        $user_id = $request->user_id;
        
        $posts = Post::select(
            'posts.id',
            'posts.title',
            'posts.message',
            'posts.type',
            'posts.created_at',
            'posts.user_id',
            'users.first_name',
            'users.last_name'
        )
        ->join('users','users.id','=','posts.user_id')
        ->when(isset($type) && $type!='all', function ($query) use ($type) {
            return $query->where('type', $type);
        })
        ->orderBy('id', 'desc')
        ->paginate(10);

        return Inertia::render('Posts/PostIndex', [
            'type' => isset($type)? $type: 'all',
            'posts' => $posts
        ]);
    }

    public function myPosts(Request $request, $type) {

        $user_id = $request->user_id;
        
        $posts = Post::select(
            'posts.id',
            'posts.title',
            'posts.message',
            'posts.type',
            'posts.created_at',
            'posts.user_id',
            'users.first_name',
            'users.last_name'
        )
        ->join('users','users.id','=','posts.user_id')
        ->when(!empty($user_id), function ($query) use ($user_id) {
            return $query->where('user_id', $user_id);
        })
        ->when(isset($type) && $type!='all', function ($query) use ($type) {
            return $query->where('type', $type);
        })
        ->orderBy('id', 'desc')
        ->paginate(10);

        return Inertia::render('Posts/MyPost', [
            'type' => isset($type)? $type: 'all',
            'posts' => $posts
        ]);
    }

    public function add(Request $request) {

        Post::create([
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'user_id' => Auth::user()->id
        ]);

        $route= Route::currentRouteName();
        return redirect($route);
    }

    public function update(Request $request) {

        Post::where('id', $request->id)->update([
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
        ]);

    }

    public function delete($id) {

        Post::where('id', $id)->delete();

    }
}
