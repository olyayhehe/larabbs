<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //category—— 一个话题属于一个分类；
    //user —— 一个话题拥有一个作者。
    //方便地通过 $topic->category、$topic->user 来获取到话题对应的分类和作者。
}
