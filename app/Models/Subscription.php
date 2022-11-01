<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public static function subscribe(Post $post, User $user)
    {
        $sub = new Subscription();
        $sub->post_id = $post->id;
        $sub->user_id = $user->id;
        return $sub;
    }

    public function getSubscriptionsForUser(User $user)
    {
        $result = $this->where('subscriptions.user_id','=',$user->id)
            ->join('posts','subscriptions.post_id','=','posts.id')
            ->select('posts.*')
            ->get();
        return $result;
    }
}
