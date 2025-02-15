<?php

namespace App\Traits;

trait HttpTrait
{
    /**
     * Generate a JSON response.
     *
     * @param mixed         $data               The data to be included in the response.
     * @param string|null   $message            An optional message to be included in the response.
     * @param int           $code               The HTTP status code for the response. Defaults to 200.
     *
     * @return \Illuminate\Http\JsonResponse    The JSON response object.
     */
    public function response($data, $message = null, $code = 200)
    {
        if (! is_numeric($code) || $code > 599 || $code < 100) {
            $code = 400;
        }

        $success = $code < 400;
        if (! isset($message)) {
            $message = '';
        }

        $response = [
            'meta'  => compact('success', 'code', 'message'),
            'data'  => $data
        ];

        return response()->json($response, $code);
    }
}
