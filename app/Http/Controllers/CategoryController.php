<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    // GET ALL CATEGORIES
    public function index()
    {
        try {
        $categories = Category::all();
        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
        
    }
}
