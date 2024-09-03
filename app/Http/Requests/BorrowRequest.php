<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class BorrowRequest extends FormRequest
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
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrowed_at',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        ];
    }
    //message the atrubite
    public function messages(): array
    {
        return [
            'user_id.required' => 'User is required.',
          
            'book_id.required' => 'Book is required.',
           
            'borrowed_at.required' => 'Borrowed date is required.',
            'return_by.required' => 'Return by date is required.',
            'return_by.after' => 'Return by date must be after the borrowed date.',
        ];
    }

//name of attrubit
    public function attributes(): array
    {
        return [
            'user_id' => 'user_id',
            'book_id' => 'book_id ',
            'borrowed_at' => 'borrowed_at',
            'return_by' => 'retern_date',
                ];
    }
    protected function failedValidation($validator)
    {
        $response = response()->json([
            'message' => 'التحقق من صحة البيانات فشل',
            'errors' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
//when passedvaidation print the input in file log
    protected function passedValidation()
    {
   
        Log::info('Borrow record validation passed for data: ', $this->all());

    }
}
