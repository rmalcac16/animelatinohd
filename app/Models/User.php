<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Hash;

use Exception;


use Animelhd\AnimesFavorite\Traits\Favoriter;
use Animelhd\AnimesView\Traits\Viewer;
use Animelhd\AnimesWatching\Traits\Watchinger;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use Favoriter;
	use Viewer;
	use Watchinger;

    protected $tokensExpireIn = 30;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function app_obtenerUsuario(){
        try {
            return auth('sanctum')->user();
        } catch (Exception $e) {
            return array(
				'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            );
        }
    }

    public function app_loguearse($request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'device_name' => 'required',
            ]);

            $user = $this->where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password))
                throw new Exception("Usuario y/o contraseña incorrectos.", 500);
                
            return array(
                'status' => 'success',
                'token' => $user->createToken($request->device_name)->plainTextToken,
                'user' => $user
            );

        } catch (Exception $e) {
            return array(
				'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            );
        }
        
    }

    public function app_registrarse($request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'device_name' => ['required']
            ]);
            $user = $this->createUser($request->only('name', 'email', 'password'));
            if (!$user)
                throw new Exception("Error al registrar el usuario", 500);
            $token = $user->createToken($request->input('device_name'))->plainTextToken;
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token
            ]);
        } catch (Exception $e) {
            return array(
				'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            );
        }
        
    }

    public function app_salir()
    {
        try {
            $user = auth('sanctum')->user();
            if(!$user->currentAccessToken()->delete())
                throw new Exception("El token no se pudo eliminar", 1);
            return response()->json([
                'status' => 'success',
                'message' => 'El token ha sido eliminado'
            ]);
        } catch (Exception $e) {
            return array(
				'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            );
        }   
    }

    public function app_salirTodo()
    {
        try {
            $user = auth('sanctum')->user();
            if(!$user->tokens()->delete())
                throw new Exception("Los tokens no se pudieron eliminar", 1);
            return response()->json([
                'status' => 'success',
                'message' => 'Todos los tokens han sido eliminado'
            ]);
        } catch (Exception $e) {
            return array(
				'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            );
        }
    }

}
