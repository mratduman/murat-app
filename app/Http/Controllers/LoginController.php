<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;

class LoginController extends Controller
{
    public function index() {

        if (Session::get('user')) {
            redirect()->route('index');
        }

        return view('login');
    }

    public function sessionStart(Request $request) {
        $user = User::query()
            ->where('email', @$request->email)
            ->where('password', @$request->password)
            ->first();

        if (!isset($user->id)) {
            return redirect()->route('login');
        }

        session(['user' => $user->id]);
        return redirect()->route('index');
    }
}
