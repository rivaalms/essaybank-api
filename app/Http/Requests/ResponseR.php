<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponseR extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $clientIp = $this->header('Requester-Ip');
        $this->merge([
            'ip_address' => base64_decode($clientIp)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ip_address'        => ['required', 'ipv4'],
            'question_id'       => ['required', 'exists:questions,id'],
            'answer'            => ['required', 'string']
        ];
    }
}
