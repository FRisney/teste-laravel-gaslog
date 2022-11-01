<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalysisController extends Controller
{
    public function create(Request $request, Post $post)
    {
        if($post->closed) {
            $request->session()->flash('postClosed','Post Fechado, nao sera possivel comentar aqui');
        }
        else if($request->has(['description','recommends'])){
            /** @var User $user */
            $user = Auth::user();
            $an = Analysis::build(
                post:$post,
                user:$user,
                description: $request->input('description'),
                recommends: $request->input('recommends')
            );
            $an->save();
            $request->session()->flash('commentCreated','Recomendação cadastrada com sucesso!');
        }
        return redirect("/post/{$post->id}");
    }

    public function form(Post $post)
    {
        return view(
            'analysis',
            [ 'post' => $post ]
        );
    }

    public function delete(Request $request, Post $post, Analysis $an)
    {
        /** @var User $user */
        $user = Auth::user();
        if($an->isOwnedBy($user)){
            $an->delete();
            $request->session()->flash('commentDeleted','Recomendação apagada com sucesso!');
        } else{
            $request->session()->flash('unauthorized','Nao autorizado a apagar esta recomendacao');
        }
        return redirect("/post/{$post->id}");
    }
}
