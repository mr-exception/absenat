<?php

namespace App\Http\Requests\Sprints;

use Illuminate\Foundation\Http\FormRequest;

use Auth;

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
            'title'                 => 'required|string|max:45',
            'description'           => 'required|string|max:200',
            'start_date_day'        => 'required|numeric|min:1|max:31',
            'finish_date_day'       => 'required|numeric|min:1|max:31',
            'start_date_month'      => 'required|numeric|min:1|max:12',
            'finish_date_month'     => 'required|numeric|min:1|max:12',
            'start_date_year'       => 'required|numeric|min:1',
            'finish_date_year'      => 'required|numeric|min:1',
        ];
    }
}
