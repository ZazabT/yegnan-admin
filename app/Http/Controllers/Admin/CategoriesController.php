<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CategoriesController extends Controller
{
    //index
    public function index(){
        $categories = Category::paginate(8);
        return view('admin.categories.index' ,compact('categories'));
    }



    
    // create
    public function create()
    {
        return view('admin.categories.create');
    }


    // Store CATEGORY
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
        ]);

        try {
            $category = Category::create($request->all());
            return redirect()->route('categories')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('categories.create')->with('error', $e->getMessage());
        } catch (QueryException $e) {
            return redirect()->route('categories.create')->with('error', $e->getMessage());
        }
    }


    // EDIT CATEGORY
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    // UPDATE CATEGORY
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
        ]);

        $category->update($request->all());
        try {
            return redirect()->route('categories')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('categories.edit', $category)->with('error', $e->getMessage());
        }catch (QueryException $e) {
            return redirect()->route('categories.edit', $category)->with('error', $e->getMessage());
        }
        
    }

    // destroy
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories')->with('success', 'Category deleted successfully.');
    }



}
