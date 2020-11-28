<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UploadDocument extends FormRequest
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
            "upload_doc"=>"required|mimes:doc,docx,pdf|max:2048"
        ];

    }

    public function messages(){
        return [
            "upload_doc.max"=>"File size too large"
        ];
    }
}
