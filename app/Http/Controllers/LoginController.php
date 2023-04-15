<?php

namespace App\Http\Controllers;

use App\Models\User;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

    /**
     * Redirect the user to the Google authentication page.
     *
     */
    public function redirectToProvider($provider)
    {

//        dd($provider);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     */
    public function handleProviderCallback($provider)
    {

//        dd($provider);

        $user = Socialite::driver($provider)->user();
//        dd($user);

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {

            Auth::login($existingUser, true);

        } else {

            $newUser = User::query()->create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(Str::random(16)),
            ]);

            Auth::login($newUser, true);
        }

        return redirect('user');

    }

}
