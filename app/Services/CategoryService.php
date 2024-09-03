<?php
namespace App\Services;

use App\Models\Category;

class CategoryService

{
    //get all category
    public function getAllCategories()
    {
        return Category::all();
    }
    /**
     * createCategory
     * @param array $data
     * @return TModel
     */
    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }
    /**
     * updateCategory
     * @param mixed $id
     * @param array $data
     * @return TModel|\Illuminate\Database\Eloquent\Collection
     */
    public function updateCategory($id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }
    /**
     *  deleteCategory
     * @param mixed $id
     * @return bool
     */
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return true;
    }
}
