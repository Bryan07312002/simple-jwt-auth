<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Retweet;
use App\Models\Like;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'has_img',
        'comment_number',
        'like_number',
        'retweet_number',
    ];

    public function rules(){
        return [
            'post_id' => 'nullable|min:1|numeric',
            'content' => 'required|min:1|max:255',
            'has_img' => 'required|boolean',
        ];
    }
    public function add_comment_number($post_id){
        $post = Post::find($post_id);
        $post->comment_number = $post->comment_number + 1;
        $post->save();
    }
    public function sub_comment_number($post_id){
        $post = Post::find($post_id);
        $post->comment_number = $post->comment_number - 1;
        $post->save();
    }
    public function comments(){
        return $this->hasMany(Post::class);
    }
    public function posts(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function retweets(){
        return $this->hasMany(Retweet::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
}
