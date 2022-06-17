<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Like extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    protected $table = 'likes'; 

    public function add_like_number($post_id){
        $post = Post::find($this->post_id);
        $post->like_number = $post->like_number + 1;
        $post->save();
    }
    public function sub_like_number($post_id){
        $post = Post::find($post_id);
        $post->like_number = $post->like_number - 1;
        $post->save();
    }

    public function likes(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
