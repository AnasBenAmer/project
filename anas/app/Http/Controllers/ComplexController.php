<?php

namespace App\Http\Controllers;
use App\Models\Complex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ComplexController extends Controller
{
    public function index(){

        $complexs= Auth::user()->complexs()->OrderByDesc('created_at')->paginate(5);
    return view('complexs.index',['complexs'=>$complexs]);
    }

    public function create()
    {
        return view('complexs.create');
    }
    public function store(Request $request){


        $complex = $request->validate([
            'name' => 'required',
            'address' => 'required',

        ]);

        Auth::user()->complexs()->create($complex);
        return redirect()->route('complex.index')->with(['success' => 'complex created successfully']);
    }
public function show (Complex $complex){
    if (Auth::user()->id !== $complex->user_id) {
        abort(403);
    }
    return view('complexs.show', ['complex' => $complex]);

}


public function destroy(Complex $complex){

 if (Auth::user()->id !== $complex->user_id) {
        abort(403);
    }
    $complex->delete();
    return redirect()->route('complex.index')->with(['success' => 'complex deleted successfully']);
}



}
