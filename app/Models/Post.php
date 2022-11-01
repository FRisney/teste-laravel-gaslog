<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }

    public function isOwnedBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    public static function build($name, $description,User $user){
        $post = new Post();
        $post->name = $name;
        $post->description = $description;
        $post->closed = false;
        $post->user_id = $user->id;
        return $post;
    }

    public function updateInfo($name,$description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->save();
    }

    public function setClosed(bool $state)
    {
        $this->closed = $state;
        $this->update();
    }
}
