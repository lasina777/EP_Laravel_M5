<?php

namespace App\Http\Requests\Admin\Competence;

use Illuminate\Foundation\Http\FormRequest;

class CompetenceUpdateValidation extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'EN_name' => 'required|unique:competences,EN_name,'.$this->competence->id,
        ];
    }
}
