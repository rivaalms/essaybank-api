<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewR;
use App\Http\Resources\ReviewRes;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewC extends Controller
{
    public function list(Request $request)
    {
        $data = Review::with($this->resolveRelations($request))->whereResponse($request->response)->whereReviewer($request->reviewer)->paginate(fn($total) => $request->per_page ?? $total);
        $data->transform(fn($item) => new ReviewRes($item));
        return $this->response($data);
    }

    public function find(Request $request, int $id)
    {
        $data = Review::with($this->resolveRelations($request))->find($id);
        return $this->response(new ReviewRes($data));
    }

    public function create(ReviewR $request)
    {
        $data = Review::create($request->validated());
        return $this->response(new ReviewRes($data));
    }

    public function update(ReviewR $request, int $id)
    {
        $data = Review::find($id)->update($request->validated());
        return $this->response($data);
    }

    public function delete(int $id)
    {
        $data = Review::find($id)->delete();
        return $this->response($data);
    }

    private function resolveRelations(Request $request)
    {
        return collect(array_filter([
            'response'          => $request->boolean('load_response'),
            'response.question' => $request->boolean('load_question'),
            'reviewer'          => $request->boolean('load_reviewer')
        ]))->map(fn ($item, $key) => $key)->values()->toArray();
    }
}
