<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePoll extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "user_id" => "required|exists:users,id",
            "poll_reason" => "required|string|max:35",
            "poll_subtitle" => "nullable|string|max:35",
            "expected_samplings" => "required|digits_between:0,7",
            "active" => "required|boolean"
        ];
    }
}
