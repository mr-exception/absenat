<?php

namespace App\Http\Requests\Projects;

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
            'title'         => 'required|string|max:45',
            'description'   => 'required|string|max:200',
            'level_id'      => 'required|numeric|exists:project_templates,id',
            'visibility'    => 'required|numeric|int:1,2',
        ];
    }
}
