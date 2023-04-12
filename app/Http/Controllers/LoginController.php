<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'string', 'min:7', 'max:50'],
        ]);

        if (!$request->has('remember')) {
            session(['lifetime' => 120]);
        }else {
            session(['lifetime' => 60 * 24 * 2]);
        }

        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            alert(__('Добро пожаловать'));

            return redirect('user');

        }

        return back()->withInput($request->except('password'));

    }

}
