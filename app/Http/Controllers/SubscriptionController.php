<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index(Subscription $subscriptions)
    {
        /** @var User $user */
        $user = Auth::user();
        $posts = $subscriptions
            ->getSubscriptionsForUser($user)
            ->reverse();
        return view(
            'subscriptions',
            [ 'posts'=> $posts ]
        );
    }

    public function subscribe(Post $post)
    {
        /** @var User $user */
        $user = Auth::user();
        try{
            $sub = Subscription::subscribe($post,$user);
            $sub->save();
        } catch (QueryException $e){
            // NADA
        }
        return redirect('/post/'.$post->id);
    }
}
