<?php

namespace App\Http\Controllers;

use App\Http\Requests\AiReviewR;
use App\Http\Resources\AiReviewRes;
use App\Models\AiReview;
use Illuminate\Http\Request;

class AiReviewC extends Controller
{
    public function list(Request $request)
    {
        $data = AiReview::with($this->resolveRelations($request))->whereResponse($request->response)->paginate(fn($total) => $request->per_page ?? $total);
        $data->transform(fn($item) => new AiReviewRes($item));
        return $this->response($data);
    }

    public function find(Request $request, int $id)
    {
        $data = AiReview::with($this->resolveRelations($request))->find($id);
        return $this->response(new AiReviewRes($data));
    }

    public function create(AiReviewR $request)
    {
        $data = AiReview::create($request->validated());
        return $this->response(new AiReviewRes($data));
    }

    public function update(AiReviewR $request, int $id)
    {
        $data = AiReview::find($id)->update($request->validated());
        return $this->response($data);
    }

    public function delete(int $id)
    {
        $data = AiReview::find($id)->delete();
        return $this->response($data);
    }

    private function resolveRelations(Request $request)
    {
        return collect(array_filter([
            'response'          => $request->boolean('load_response'),
            'response.question' => $request->boolean('load_question'),
        ]))->map(fn ($item, $key) => $key)->values()->toArray();
    }
}
