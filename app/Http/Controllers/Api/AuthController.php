<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthController extends Controller
{

    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }


    public function getUser()
    {
        return $this->user->app_obtenerUsuario();
    }


    public function loginUser(Request $request)
    {
        return $this->user->app_loguearse($request);
    }

    public function registerUser(Request $request)
    {
        return $this->user->app_registrarse($request);	
    }

    public function logoutUser()
    {
        return $this->user->app_salir($request);
    }

    public function logoutAllDeleteTokens()
    {
        return $this->user->app_salirTodo($request);
    }

}
