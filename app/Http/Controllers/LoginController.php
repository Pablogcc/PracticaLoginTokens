<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required'
        ]);

        
        if(Auth::attempt($data)) {
            return response()->json([
                'success' => true,
                'message' => 'El usuario está logueado',
                'data' => Auth::user()->createToken("token")
                ]);
              
        }

    }

    public function whoAmI(Request $request) {
        // Aquí pilla el token que se pone en el postman y lo pone en $token
        $token = $request->bearerToken();
        // Aquí verifica el token en la tabla personal_access_tokens
        $tokenModel = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
    
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
    // Obtener el token del encabezado de la solicitud
    $token = $request->bearerToken();

    // Comprobar si el token existe
    if ($token) {
        // Buscar el token en la base de datos
        $tokenModel = \Laravel\Sanctum\PersonalAccessToken::findToken($token);

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
    } else {
        // Si no se encontró el token en la solicitud
        return response()->json([
            'success' => false,
            'message' => 'No se encontró un token en la solicitud.',
        ], 401);
    }
}

    


    
}
