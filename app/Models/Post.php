<?php

namespace App\Models;

// use App\Policies\PostPolicy;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

// #[UsePolicy(PostPolicy::class)]
class Post extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */ 
    protected $fillable = [
        'title', 
        'content',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
