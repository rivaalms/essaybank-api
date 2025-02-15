<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiReview extends Model
{
    /** @use HasFactory<\Database\Factories\AiReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'response_id',
        'score',
        'feedback'
    ];

    public function response()
    {
        return $this->belongsTo(Response::class, 'response_id', 'id');
    }
}
