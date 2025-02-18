<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = request()->user();
        return [
            'id'                => $this->id,
            'question'          => $this->question,
            'reference_answer'  => $this->when(isset($user), $this->reference_answer),
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at
        ];
    }
}
