<?php

namespace AbediMostafa\ToDo\http\Controllers;

use AbediMostafa\ToDo\http\Requests\LoginRequest;
use AbediMostafa\ToDo\http\Requests\RegisterUserRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display login page
     */
    public function login(): \Illuminate\View\View
    {
        return view('todo::login');
    }

    /**
     * Display register page
     */
    public function register(): \Illuminate\View\View
    {
        return view('todo::register');
    }

    /**
     * Handles register process
     */
    public function handleRegister(RegisterUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $token = Str::random(80);

        return tryCatch(
            function () use ($token) {
                (new User())
                    ->addApiTokenToFillAble()
                    ->makeUser($token);
            },
            'Problem registering User',
            'User registered successfully',
            ['token' => $token, 'userName' => request('name')]
        );
    }

    /**
     * Handles login process
     */
    public function handleLogin(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::attempt($request->all())) {

            //Regenerate user token and save to db before login
            Auth::user()->tokenRenew($token = Str::random(80));

            return successJson(
                'User successfully logged in',
                ['token' => $token, 'userName' => Auth::user()->name]
            );
        }

        return errorJson('Email or password is incorrect');
    }

    /**
     * Logout the user
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
