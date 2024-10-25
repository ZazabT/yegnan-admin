<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //index
    public function index(){
        $categories = Category::paginate(8);
        return view('admin.categories.index' ,compact('categories'));
    }
}
