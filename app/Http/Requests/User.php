<?php

namespace App\Http\Requests;

use Dotenv\Validator;
use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:email',
			'full_name' => 'required|min:6',
			'phone' => 'required|max:9',
			'password' => 'required|min:6'
        ];
    }

    public function validated($data) {
		$validator =  Validator::make($data, $this->rules());
		return $validator;
    }
}
