<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Host;
use Illuminate\Http\Request;

class HostController extends Controller
{
    //index
    public function index()
    {
        $hosts = Host::with(['user', 'listings'])->paginate(8);
        return view('admin.host.index', compact('hosts'));
    }
}
