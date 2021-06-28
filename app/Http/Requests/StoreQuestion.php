<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestion extends FormRequest
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
            "poll_id" => "required|exists:polls,id",
            "question" => "required|string|max:255",
            "type"  =>  "required|in:Bool,Check,Float,Integer,Multi Checker,Text",
            "required"  =>  "required|boolean"
        ];
    }
}