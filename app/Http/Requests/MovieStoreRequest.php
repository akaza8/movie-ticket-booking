<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieStoreRequest extends FormRequest
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
        'title' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'rating' => 'required|numeric|min:0|max:10',
        'duration' => 'required|integer',
        'cast' => 'required|string',
        'theatre_id' => 'required|exists:theatres,id',
        'showtime' => 'required|date',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
