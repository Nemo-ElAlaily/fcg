<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
     * Derive the slug the controller will store, so uniqueness can be validated.
     */
    protected function prepareForValidation()
    {
        $this->merge(['slug' => str_replace(characters(), '-', (string) $this->title)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['required', Rule::unique('projects', 'slug')->ignore($this->route('project'))],
            'category_id' => ['nullable', 'exists:categories,id'],
            'client_id'   => ['nullable', 'exists:clients,id'],
            'services'    => ['required', 'array'],
            'services.*'  => ['exists:services,id'],
            'image'       => ['nullable', 'image', 'max:2048'], // KB; matches PHP upload_max_filesize (2M)
            'gallery.*'   => ['nullable', 'image', 'max:2048'],
        ];
    }
}
