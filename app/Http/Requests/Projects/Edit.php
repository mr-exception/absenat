<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class Edit extends FormRequest{
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
            'title'         => 'nullable|string|max:45',
            'description'   => 'nullable|string|max:200',
            'level_id'      => 'nullable|numeric|exists:project_templates',
            'visibility'    => 'nullable|numeric|int:1,2',
        ];
    }
}
