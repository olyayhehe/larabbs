<?php

namespace App\Models;

class Topic extends Model
{
    // protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
    // user_id —— 文章的作者，我们不希望文章的作者可以被随便指派；
    // last_reply_user_id —— 最后回复的用户 ID，将有程序来维护；
    // order —— 文章排序，将会是管理员专属的功能；
    // reply_count —— 回复数量，程序维护；
    // view_count —— 查看数量，程序维护；

    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
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
    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        // 预加载防止 N+1 问题
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
}


















