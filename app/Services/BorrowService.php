<?php
namespace App\Services;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrow_records;
class BorrowService{
// public function createBorrowRecord(array $data)
public function createBorrowRecord(array $data)
    {
    $book = Book::find($data['book_id']);
    

    $user = User::find($data['user_id']);
    if ($book->is_borrowed) {
        throw new \Exception('This book is currently borrowed by another user.');
    }
    $dueDate = now()->addDays(14);

    $borrowRecord = Borrow_records::create([
        'user_id' => $data['user_id'],
        'book_id' => $data['book_id'],
        'borrowed_at' => now(),
        'return_by' => $data['return_by'] ?? now()->addDays(14),
        'due_date' => $dueDate,
    ]);

    $book->is_borrowed = true;
    $book->save();

    return $borrowRecord;
}
/**
 *  updateBorrowRecord
 * @param mixed $id
 * @param array $data
 * @return TModel|\Illuminate\Database\Eloquent\Collection|null
 */
public function updateBorrowRecord($id, array $data)
{
    $borrowRecord = Borrow_records::find($id);
    

    $borrowRecord->update([
        'return_by' => $data['return_by'] ?? $borrowRecord->return_by,
        'returned_at' => $data['returned_at'] ?? $borrowRecord->returned_at,
    ]);

    if ($data['returned_at']) {
        $book = Book::find($borrowRecord->book_id);
        $book->is_borrowed = false;
        $book->save();
    }

    return $borrowRecord;
}
/**
 *deleteBorrowRecord
 * @param mixed $id
 * @return TModel|\Illuminate\Database\Eloquent\Collection|null
 */
public function deleteBorrowRecord($id)
{
    $borrowRecord = Borrow_records::find($id);
   

    $book = Book::find($borrowRecord->book_id);
    $book->is_borrowed = false;
    $book->save();

    $borrowRecord->delete();
    return $borrowRecord;
}

public function getBorrowRecords()
{
     $borrowRecord= Borrow_records::all();
     return $borrowRecord;
}



}