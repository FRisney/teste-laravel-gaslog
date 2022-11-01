<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function feed(Post $post)
    {
        $posts = $post->all()->reverse();
        return view('feed',[
            'posts'=>$posts,
        ]);
    }

    public function create(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $post = Post::build(
            $request->input('name'),
            $request->input('description'),
            $user
        );
        $post->save();
        return redirect('/feed');
    }

    public function edit(Request $request, Post $post, string $operation=null)
    {
        if(Auth::user()->id == $post->user_id){
            if(!$operation){
                $post->updateInfo(
                    $request->input('name'),
                    $request->input('description')
                );
            } else  {
                $post->setClosed($operation == 'close');
            }
        }
        return redirect('/post/'.$post->id);
    }

    public function show(Post $post)
    {
        return view('post.details',[
            'post'=> $post,
            'isAuthor' => Auth::user()->id == $post->user_id,
        ]);
    }

    public function delete(Post $post)
    {
        if(Auth::user()->id == $post->user_id) {
            $post->delete();
        }
        return redirect('/feed');
    }
}
