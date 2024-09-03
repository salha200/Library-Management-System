<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\BookService;
use Response;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    protected $BookService;
 /**
     * constractor to inject categoryService class
     * @param BookService $BookService
     */ 
public  function __construct( BookService $BookService){
    $this->BookService = $BookService;
    
}
       /**
 * Retrieve a list of all book.
 *
 * This method fetches all book from the database through the 
 * bookService and returns them in a JSON response. The response

 * code of 200 indicating a successful operation.
 *
 * @return \Illuminate\Http\JsonResponse
 */
    public function index()
    {
        $books=$this->BookService->getBook();
        return response()->json(['data'=>$books,"message"=>"get book success"],200);
        }

    /**
     * Store a newly created resource in storage.
     * @param BookRequest $request
     * 
    * @return \Illuminate\Http\JsonResponse
     */ 
    public function store(BookRequest $request)
    {

        $data=$request->validated();
        Log::info('Creating book with data: ', $data);

        $book=$this->BookService->createBook($data);
        // Log::info('Creating book with data: ', $book);

        return response()->json(['data'=>$book,"message"=>"add book success"],200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the book
     * @param BookRequest $request
     * @param $id
     */
    public function update(BookRequest $request, $id)
    {
        // التحقق من صحة البيانات الواردة من الطلب
        $data = $request->validated();

        // تحديث الكتاب
        $book = $this->BookService->updateBook($id, $data);


        return response()->json(['data' => $book, 'message' => 'Book updated successfully'], 200); // الكتاب تم تحديثه بنجاح
    }

    /**
     * delet the book form databas
     * @param Book $book
     *  @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $books=$this->BookService->deletBook($book);
        return response()->json(['data'=>$books,"message"=>"delete book success"],200);
    }
    /**
     * 
     * filter the book with BookService about  available and category and author
     * @param Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
       
        $books = $this->BookService->filterBooks($request->all());

        return response()->json(['data' => $books], 200);
    }
}
