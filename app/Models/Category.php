<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    Schema::create('categories', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name')->index()->comment('名称');
    $table->text('description')->nullable()->comment('描述');
    $table->integer('post_count')->default(0)->comment('帖子数');
    $table->timestamps();
    });
}
