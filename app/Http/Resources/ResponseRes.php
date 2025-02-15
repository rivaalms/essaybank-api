<?php

namespace App\Http\Resources;

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
            'id'                => $this->id,
            'question_id'       => $this->question_id,
            'question'          => $this->whenLoaded('question', fn () => $this->question->question),
            'reference_answer'  => $this->whenLoaded('question', fn () => $this->question->reference_answer),
            'answer'            => $this->answer,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at
        ];
    }
}
