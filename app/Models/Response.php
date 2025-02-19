<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    /** @use HasFactory<\Database\Factories\ResponseFactory> */
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'question_id',
        'answer'
    ];

    protected $hidden = [
        'ip_address'
    ];

    protected function casts()
    {
        return [
            'ip_address'        => 'string',
            'id'                => 'integer',
            'question_id'       => 'integer'
        ];
    }

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

    public function scopeWhereIpAddress(Builder $query, ?string $ip)
    {
        if (auth('sanctum')->user()) return;
        $query->when($ip ?? false, fn(Builder $query, string $ip) => $query->where('ip_address', base64_decode($ip)));
    }

    public function scopeWhereQuestion(Builder $query, ?int $id)
    {
        $query->when($id ?? false, fn(Builder $query, int $id) => $query->where('question_id', $id));
    }
}
