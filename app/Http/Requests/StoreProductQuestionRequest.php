<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only authenticated users can ask questions
        return \Illuminate\Support\Facades\Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'min:5', 'max:1000'],
        ];
    }

    /**
     * Prepare the data for validation.
     * Ensure user_id is taken from auth, not request input.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
        ]);
    }
}
