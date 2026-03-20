<?php

namespace App\Http\Controllers\Api\Iroda;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login Iroda user and create token
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'The provided credentials are incorrect.',
                    'debug' => 'User found: ' . ($user ? 'yes' : 'no') . ', Email: ' . $request->email
                ], 401);
            }

            // Check if user has Iroda or Admin privileges
            if (!$user->is_iroda && !$user->is_admin) {
                return response()->json([
                    'message' => 'Access denied. Iroda privileges required.',
                    'debug' => 'User roles - iroda: ' . ($user->is_iroda ? 'yes' : 'no') . ', admin: ' . ($user->is_admin ? 'yes' : 'no')
                ], 403);
            }

            // Revoke previous tokens
            $user->tokens()->delete();

            // Create new token
            $token = $user->createToken('iroda-desktop-app', ['iroda-access'])->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed: ' . $e->getMessage(),
                'debug' => 'Exception: ' . $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Logout user and revoke token
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Get authenticated user info
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => [
                'id' => $request->user()->id,
                'name' => $request->user()->name,
                'email' => $request->user()->email,
                'is_iroda' => $request->user()->is_iroda,
                'is_admin' => $request->user()->is_admin,
            ]
        ]);
    }
}
