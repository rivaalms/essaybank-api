<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionC extends Controller
{
    public function make(Model $model, string $label, string $value = 'id', ?\Closure $additionalQuery = null)
    {
        $data = DB::table($model->getTable())->select("{$label} as label", "{$value} as value");
        if (isset($additionalQuery)) {
            $data = $additionalQuery($data);
        }
        return $data->get();
    }

    public function questions(Request $request)
    {
        $data = $this->make(new Question(), 'question', 'id');
        return $this->response($data);
    }
}
