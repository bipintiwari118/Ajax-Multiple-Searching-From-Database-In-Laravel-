<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class SearchController extends Controller
{
    public function Search(Request $request){
        $users = UserModel::query();
        if ($request->ajax()) {
         $users = $users->where('name','LIKE','%'.$request->search.'%')
         ->orWhere('email','LIKE','%'.$request->search.'%')
         ->orWhere('phone','LIKE','%'.$request->search.'%')
         ->get();
         return response()->json(['users'=>$users]);
        } else {
            $users = $users->get();
           return view('Search',compact('users'));
        }


    }
}
