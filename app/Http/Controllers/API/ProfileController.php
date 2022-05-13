<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return $user = Auth::user();
    }
    public function update()
    {
        // return request()->name;
        request()->validate([
            "name"=>"required|max:20",
            "email"=>"required|email"
        ]);
        $user = Auth::user();
        $user->name = request()->name;
        $user->email = request()->email;
        $user->save();
        return $user;
    }
}
