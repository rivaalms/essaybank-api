<?php

namespace App\Http\Resources;

use App\Models\AiReview;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                        => $this->id,
            'question_id'               => $this->question_id,
            'question'                  => $this->whenLoaded('question', fn () => $this->question->question),
            'reference_answer'          => $this->whenLoaded('question', fn () => $this->question->reference_answer),
            'answer'                    => $this->answer,
            'total_reviews'             => $this->when($request->boolean('review_count'), $this->loadReviewCount($this->id)),
            'total_ai_reviews'          => $this->when($request->boolean('review_count'), $this->loadAiReviewCount($this->id)),
            'created_at'                => $this->created_at,
            'updated_at'                => $this->updated_at
        ];
    }

    private function loadReviewCount($id)
    {
        return Review::where('response_id', $id)->count();
    }

    private function loadAiReviewCount($id)
    {
        return AiReview::where('response_id', $id)->count();
    }
}
