<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $req){
        $this->validate($req,[
            'username' => 'required|unique:users,username,1,id',
            'password' => 'required|confirmed',
        ]);
        $username = $req->input('username');
        $pass = Hash::make($req->input('password'));
        $newEmp = User::create(["username" => $username, "password" => $pass]);
        return response()->json($newEmp,201);

    }

    public function update($id, Request $req){
        $this->validate($req,[
            //'Matricule' => 'required',
            'Prenom' => 'required',
            'Nom' => 'required',
            'email' => 'required|email|unique:employes',
            'PhoneNumber' => 'required',
        ]);
        $empUpdated = Employe::findOrFail($id);
        $empUpdated->update($req->all());
        return response()->json($empUpdated,200);
        
    }

    public function delete($id){
        $empDeleted = Employe::findOrFail($id)->delete();
        return response("Suppression effectué avec success !!!",200);
    }
}
