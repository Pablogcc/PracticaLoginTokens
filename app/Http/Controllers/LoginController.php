<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function login(Request $request) {
        // Aquí pedimos los datos al usuario que supuestamente esá logueado para validar si están en la base de datos.
        $data = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required'
        ]);

        //
        if(Auth::attempt($data)) {
            return response()->json([
                'success' => true,
                'message' => 'El usuario está logueado',
                // Aquí devuelve el usuario autenticado y le crea un token con el nombre de "token"
                'data' => Auth::user()->createToken("token")
                ]);
              
        } else {
            return response()->json([
                'success' => false,
                'message' => 'El usuario no está logueado',
                'data' => $data
            ]);
        }

    }

    public function whoAmI(Request $request) {
        // Aquí pilla el token que se pone en el postman y lo pone en $token
        $token = $request->bearerToken();
        // Aquí verifica el token en la tabla personal_access_tokens
        $tokenModel = PersonalAccessToken::findToken($token);
    
        // Aquí accede al usuario con ese token
        $usuario = $tokenModel->tokenable;
    
        return response()->json([
            'success' => true,
            'message' => 'El usuario está logueado.',
            'data' => [
                'id' => $usuario->id,
                'name' => $usuario->name,
                'password' => $usuario->password,
            ],
        ]);
    }


    public function logout(Request $request)
{
    // Aquí pillas el token del encabezado de la solicitud
    $token = $request->bearerToken();

    // Comprobar si el token existe
    if ($token) {
        // Buscar el token en la base de datos
        $tokenModel = PersonalAccessToken::findToken($token);

        // Si encontramos el token, lo eliminamos
        if ($tokenModel) {
            $tokenModel->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada correctamente.',
            ]);
        } else {
            // Si el token no es válido o no se encuentra
            return response()->json([
                'success' => false,
                'message' => 'Token no válido o no encontrado.',
            ], 401);
        }
    }
}

    
}
