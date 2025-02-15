<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    /** @use HasFactory<\Database\Factories\ResponseFactory> */
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'response_id', 'id');
    }

    public function aiReviews()
    {
        return $this->hasMany(AiReview::class, 'response_id', 'id');
    }
}
