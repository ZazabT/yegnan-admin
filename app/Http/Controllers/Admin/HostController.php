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


    // destroy
    public function destroy($id)
    {
        $host = Host::find($id);
        $host->delete();
        return redirect()->route('hosts');
    }


    // varify a host
    public function verify(Host $host)
    {
        try {
            // Toggle the verify status
            $host->isVerified = !$host->isVerified;
            $host->save();
    
            return redirect()->route('hosts')->with('success', 'Host verification status updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('hosts.index')->with('error', $th->getMessage());
        }
    }
    
}
