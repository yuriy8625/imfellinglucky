<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {

    }

    public function index()
    {
        return view('welcome');
    }

    public function registration(RegistrationRequest $request)
    {
        $user = $this->authService->getOrCreateUser($request->username, $request->phone_number);

        return redirect()->route('page-a.index', $user->token);
    }

    public function refreshToken(User $user)
    {
        $user = $this->authService->refreshToken($user);

        return redirect()->route('page-a.index', $user->token);
    }

    public function deactivateToken(User $user)
    {
       $this->authService->deactivateToken($user);

        return redirect()->route('welcome');
    }
}
