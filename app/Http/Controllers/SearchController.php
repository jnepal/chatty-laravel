<?php

namespace Chatty\Http\Controllers;

use Chatty\Models\User;
use Illuminate\Http\Request;

use Chatty\Http\Requests;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getSearch(Request $request){
        /**
         * Search Operation
         */
        $query = $request->input('query');

        if(!$query){
            return redirect('/');
        }

        $users = User::where(DB::raw("CONCAT(first_name, '', last_name)"), 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->get();

        return view('search._results', compact('users'));
    }


}
