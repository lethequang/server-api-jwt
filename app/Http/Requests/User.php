<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
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
            'email' => 'required|unique:users,email,' . $this->id,
			'full_name' => 'required|min:3',
			'phone' => 'required|min:9',
			'password' => 'required|min:6',
        ];
    }

    /*
     * Override form request laravel function
     */
    public function validateResolved()
	{
		//
	}


	public function validated() {
		$validator =  Validator::make($this->validationData(), $this->rules(), $this->messages());
		$errors = array();
		if ($validator->fails()) {
			$errors = $validator->errors();
		}
		return $errors;
    }
}
