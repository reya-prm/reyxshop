<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only authenticated & verified users can submit reviews
        return \Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->hasVerifiedEmail();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // rating 1‑5 integer
            'rating' => ['required', 'integer', \Illuminate\Validation\Rule::in([1,2,3,4,5])],
            // content optional, trimmed, max 1000 chars
            'content' => ['nullable', 'string', 'max:1000'],
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
