<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AiReviewRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'response_id'   => $this->response_id,
            'question'      => $this->when($this->relationLoaded('response') && $this->response->relationLoaded('question'), fn () => $this->response->question->question),
            'answer'        => $this->whenLoaded('response', fn () => $this->response->answer),
            'score'         => $this->score,
            'feedback'      => $this->feedback,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
