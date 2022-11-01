<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function isOwnedBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function authorName()
    {
        return $this->user->name;
    }

    /**
     * @param Post $post
     * @param User $user
     * @param string $description
     * @param Recommendation $recommends
     * @return static
     */
    public static function build($post,$user,$description,$recommends)
    {
        $an = new Analysis();
        $an->user_id = $user->id;
        $an->post_id = $post->id;
        $an->description = $description;
        $an->recommends = $recommends;
        return $an;
    }
}
