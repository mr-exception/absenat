<?php

namespace App\Http\Requests\Members;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Create extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'permission'    => 'required|numeric',
            'email'         => 'required|string|exists:users,email',
            'project_id'    => 'required|numeric|exists:projects,id',
        ];
    }
}