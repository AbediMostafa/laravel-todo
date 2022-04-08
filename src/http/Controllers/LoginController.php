<?php

namespace AbediMostafa\ToDo\http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login()
    {
        return view('todo::login');
    }

}
