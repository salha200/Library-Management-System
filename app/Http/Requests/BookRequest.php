<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BookRequest extends FormRequest
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
         'title' => 'required|string|unique:books,title',
        'author' => 'required|string|min:3|max:255',
        'description' => 'string|nullable|max:1000', 
        'category_id' => 'required|exists:categories,id',
        'published_at' => 'nullable|date', 
        ];
    }
    // prepare for the book
    public function prepareForValidation(){
        $this->merge([
            'title' => ucfirst(trim($this->title)),
            'author' => ucwords(trim($this->author)),
        ]);
        

    }
    //message for book
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'author.required' => 'Author name is required.',
            'author.min' => 'Author name must be at least 3 characters.',
        ];
    }
    //name of attribute the book
    public function attributes(): array
    {
        return [
            'title' => 'Name of  Book',
            'author' => 'Name of Author',
            'published_year' => 'published_year '
        ];
    }
    //failed in input
    protected function failedValidation(Validator $validator)
    {
       
        $response = response()->json([
            'status' => 'error',
            'message' => 'Validation failed for BorrowRecordFormRequest',
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
    //when passed the input
    protected function passedValidation()
    {
        Log::info('Book validation passed:', [
            'title' => $this->title,
            'author' => $this->author,
        ]);
    }
    

}
