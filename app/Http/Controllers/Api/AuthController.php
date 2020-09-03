<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Console\Kernel;

class AuthController extends Controller
{


/**
 * @OA\SecurityScheme(
 *     @OA\Flow(
 *         flow="clientCredentials",
 *         tokenUrl="http://127.0.0.1:8001/oauth/token",
 *         authorizationUrl="oauth/token",
 *         scopes={}
 *     ),
 *     securityScheme="passport",
 *     in="header",
 *     type="oauth2",
 *     description="Oauth2 security",
 *     name="oauth2",
 *     scheme="http",
 *     bearerFormat="bearer",
 * )
 */

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

    /**
    * @OA\Post(
    *     path="Api/mailvalidator",
    *     operationId="emailValidator",
    *     tags={"email/validate"},
    *     summary="validar dir de mail",
    *     description="Return validez",
    *     security={{"passport":{}},},
    *     @OA\Parameter(
    *       name="email",
    *       in="query",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *           )
    *       ),
    *      @OA\Response(
    *         response=200,
    *         description="Respuesta sobre el Mail",
    *          @OA\MediaType(
    *           mediaType="application/json",
    *           )
    *          ),
    *   @OA\Response(
    *      response=401,
    *       description="Unauthenticated"
    *   ),
    *   @OA\Response(
    *      response=400,
    *      description="Bad Request"
    *   ),
    *   @OA\Response(
    *      response=404,
    *      description="not found"
    *   ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    * ),
    */

    public function mailValidator (Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email:rfc,dns',
        ]);

        if ( $validatedData){
            return response()->json(['validate' => TRUE]);
        } else {
            return response()->json(['validate'  => false]);
        }
    }
}



