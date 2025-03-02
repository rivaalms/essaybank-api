<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    protected $fillable = [
        'question',
        'reference_answer'
    ];

    public function responses()
    {
        return $this->hasMany(Response::class, 'question_id', 'id');
    }

    public function scopeSearch(Builder $query, ?string $search)
    {
        $query->when($search ?? false, fn(Builder $query, string $search) => $query->whereAny(['question'], 'like', "%$search%"));
    }
}
