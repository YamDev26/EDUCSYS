<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'civility' => 'required|in:m,mde',
            'name1' => 'required|string',
            'name2' => 'required|string',
            'phon1' => 'required|digits:10',
            'phon2' => 'nullable|digits:10',
            'fonction' => 'required|string',

            // Student Validation
            'matricul' => 'required|string|size:9',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'genre' => 'required|in:M,F',
            'date' => 'required|date',
            'lieu' => 'required|string',
            'nation' => 'required|string',
            'residence' => 'required|string',
            'school' => 'required|string',
            'level' => 'required|integer',
            'classe' => 'required|string',
            'doublant' => 'required|in:oui,non',
            'status' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ];
    }
}
