<?php
namespace App\Services;

use App\Models\Book;
use Request;
use Illuminate\Support\Facades\Log;

class BookService{
    //get the book
public function getBook(){

    $books=Book::all();
    return $books;
}
/**
 *  createBook
 * @param array $data
 * @return TModel
 */
public function createBook(array $data){
    $publishedAt = isset($data['published_at']) ? $data['published_at'] : null;


    $book=Book::create([
'title' => $data['title'],
        'author' => $data['author'],
        'category_id' => $data['category_id'],
        'description' =>$data['description'] ?? null,
        'published_at' => $publishedAt,
        'is_available' => $data['is_available'] ?? true,

    ]);
    return $book;
    Log::info('Book created successfully:', ['book' => $book]);
}
/**
 * deletBook
 * @param Book $book
 * @return void
 */
public function deletBook(Book $book){

    $book->delete();

   
}
/**
 *  updateBook
 * @param mixed $id
 * @param array $data
 * @return TModel|\Illuminate\Database\Eloquent\Collection|null
 */
public function updateBook($id, array $data)
{
    $book = Book::find($id);

    // تحقق مما إذا كان الكتاب موجوداً
    if ($book) {
        $book->update([
            'title' => $data['title'] ?? $book->title, // إذا لم تكن القيمة موجودة في البيانات، احتفظ بالقيمة الحالية
            'author' => $data['author'] ?? $book->author,
            'description' => $data['description'] ?? $book->description,
            'published_at' => $data['published_at'] ?? $book->published_at

        ]); // تحديث الكتاب
        return $book; // إرجاع الكتاب المحدث
    }

    return null; // إرجاع null إذا لم يتم العثور على الكتاب
}

/**
 * filterBooks with category or available or title or author
 * @param array $filters
 * @return \Illuminate\Database\Eloquent\Collection
 */
public function filterBooks(array $filters)
{
    
    $query = Book::query();


    Log::info('Filtering books with filters: ', $filters);

    if (isset($filters['title'])) {
        $query->where('title', 'like', '%' . $filters['title'] . '%');
    }

 
    if (isset($filters['author'])) {
        $query->where('author', 'like', '%' . $filters['author'] . '%');
    }

    if (isset($filters['category_id'])) {
        $query->where('category_id', $filters['category_id']);
    }

    if (isset($filters['is_available'])) {
        $query->where('is_available', $filters['is_available'] );
    }

    Log::info('Final query: ', ['query' => $query->toSql(), 'bindings' => $query->getBindings()]);

    return $query->get();
}

}