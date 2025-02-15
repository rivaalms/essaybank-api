<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionR;
use App\Http\Resources\QuestionRes;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionC extends Controller
{
    public function list(Request $request)
    {
        $data = Question::paginate(fn($total) => $request->per_page ?? $total);
        $data->transform(fn ($item) => new QuestionRes($item));
        return $this->response($data);
    }

    public function find(int $id)
    {
        $data = Question::find($id);
        return $this->response(new QuestionRes($data));
    }

    public function create(QuestionR $request)
    {
        $data = Question::create($request->validated());
        return $this->response(new QuestionRes($data));
    }

    public function update(QuestionR $request, int $id)
    {
        $data = Question::find($id)->update($request->validated());
        return $this->response($data);
    }

    public function delete(int $id)
    {
        $data = Question::find($id)->delete();
        return $this->response($data);
    }
}
