<?php
namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    protected $categoryService;
      /**
     * constractor to inject categoryService class
     * @param CategoryService $categoryService
     */ 
     public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
   /**
 * Retrieve a list of all categories.
 *
 * This method fetches all categories from the database through the 
 * CategoryService and returns them in a JSON response. The response

 * code of 200 indicating a successful operation.
 *
 * @return \Illuminate\Http\JsonResponse
 */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return response()->json(['data' => $categories], 200);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());
        $data['user_id'] = Auth::id(); 

        return response()->json(['data' => $category, 'message' => 'Category created successfully'], 201);
    }
/**
 * Store a newly created category in storage.
 *
 * This method handles the creation of a new category. It uses the 
 * `CategoryRequest` to validate the incoming request data.
 * creation of the category along with the category data and a 
 * 201 status code.
 *
 * @param CategoryRequest $request 
 * 
 * @return \Illuminate\Http\JsonResponse 
 */
    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return response()->json(['data' => $category], 200);
    }

    /**
 * upate the category already exist
 * @param CategoryRequest $request
 
 * @return mixed|\Illuminate\Http\JsonResponse
 */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryService->updateCategory($id, $request->validated());
        return response()->json(['data' => $category, 'message' => 'Category updated successfully'], 200);
    }
    /**
 * destroy the category already exist
 * @param $id
 
 * @return mixed|\Illuminate\Http\JsonResponse
 */

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
