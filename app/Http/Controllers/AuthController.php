<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     */
    public function login(Request $request, User $user)
    {
        if($request->method() == 'GET'){
            return view('login');
        }
        if(!$request->has(['login','password'])){
//            $request->session()->flash('fields','campos invalidos');
            return redirect('auth');
        }
        try {
            $user = $user->findByCredentials(
                login: $request->input('login'),
                password: $request->input('password')
            );
        } catch (\Exception $e) {
//            $request->session()->flash('crendentials','credenciais invalidas');
            return redirect('auth');
        }
        $user->updateLastLogin();
        Auth::login($user);
        return redirect('feed');
    }

    public function register(Request $request, User $user)
    {
        if($request->getMethod() == 'GET'){
            return view('register');
        }
        if(!$request->has(['login','password','name'])){
//            $request->session()->flash('fields','campos invalidos');
            return redirect('auth/register');
        }
        $user->registerNewUser(
            login: $request->input('login'),
            password: $request->input('password'),
            name: $request->input('name')
        );
        Auth::login($user);
        return redirect('feed');
    }
}
