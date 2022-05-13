<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function __construct()
     {
        return $this->middleware("auth:api");
     }
    public function index()
    {
        $categories = Category::all();
        return $categories;
    }
    public function store()
    {
        $data = request()->validate([
            "category" => "required|string|max:15|unique:categories"
        ]);

        Category::create($data);
        return $data;
    }
    public function edit($id)
    {
        $category = Category::FindorFail($id);
        return $category;
    }
    public function update($id)
    {
        $data = request()->validate([
            "category" => "required|string|max:40"
        ]);
        $category = Category::FindorFail($id);
        $category->update($data);
        return $category;
    }
    public function delete($id)
    {
        $category = Category::FindorFail($id);
        $category->delete($id);
        return $category;
    }
}
