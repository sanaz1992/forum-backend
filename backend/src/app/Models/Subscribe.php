<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'thread_id',
        'user_id'
    ];

    /**
     * Get the thread that owns the answer.
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * Get the user that owns the answer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
