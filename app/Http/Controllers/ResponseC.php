<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResponseR;
use App\Http\Resources\ResponseRes;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseC extends Controller
{
    public function list(Request $request)
    {
        $data = Response::with($this->resolveRelations($request))->whereIpAddress($request->header('Requester-Ip'))->whereQuestion($request->question)->paginate(fn($total) => $request->per_page ?? $total);
        $data->transform(fn($item) => new ResponseRes($item));
        return $this->response($data);
    }

    public function find(Request $request, int $id)
    {
        $data = Response::with($this->resolveRelations($request))->find($id);
        return $this->response(new ResponseRes($data));
    }

    public function create(ResponseR $request)
    {
        $data = Response::create($request->validated());
        return $this->response(new ResponseRes($data));
    }

    public function update(ResponseR $request, int $id)
    {
        $data = Response::find($id)->update($request->validated());
        return $this->response($data);
    }

    public function delete(int $id)
    {
        $data = Response::find($id)->delete();
        return $this->response($data);
    }

    private function resolveRelations(Request $request)
    {
        return collect(array_filter([
            'question'          => $request->boolean('load_question'),
            'reviews'           => $request->boolean('load_reviews'),
            'aiReviews'         => $request->boolean('load_ai_reviews'),
        ]))->map(fn ($item, $key) => $key)->values()->toArray();
    }
}
