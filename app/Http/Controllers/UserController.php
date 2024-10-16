<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     // get all user 
     public function index(){
        $users = User::paginate(8);
        return view('admin.users.index', compact('users'));
     }

     // delete user
     public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
     }
}
