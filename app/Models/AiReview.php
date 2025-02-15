<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    protected function casts()
    {
        return [
            'score'         => 'float',
            'response_id'   => 'integer',
        ];
    }

    public function response()
    {
        return $this->belongsTo(Response::class, 'response_id', 'id');
    }

    public function scopeWhereResponse(Builder $query, ?int $id)
    {
        $query->when($id ?? false, fn(Builder $query, int $id) => $query->where('response_id', $id));
    }
}
