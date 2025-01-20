<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => 200,
            'massage' => 'Categories retrieved successfuly.',
            'data' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $category = Category::create($request->all());

        return response()->json([
            'status' => 201,
            'massage' => 'Category created successfult.',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {

        $category = Category::find($id);

        if(!$category) {
            return response()->json([
             'status' => 404,
             'massage' => 'Category not found.',
             'data' => null  
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'massage' => 'Category created successfult.',
            'data' => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([
             'status' => 404,
             'massage' => 'Category not found.',
             'data' => null  
            ], 404);
        }

        $request->validate(['name' => 'string[max:255']);
        $category->update($request->all());

        return response()->json([
            'status' => 200,
            'massage' => 'Category created successfult.',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([
             'status' => 404,
             'massage' => 'Category not found.',
             'data' => null  
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 200,
            'massage' => 'Category created successfult.',
            'data' => null
        ], 200);
    }
}
