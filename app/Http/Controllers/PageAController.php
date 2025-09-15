<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GameService;

class PageAController extends Controller
{
    public function __construct()
    {

    }

    public function index(User $user)
    {
        return view('page-a', compact('user'));
    }

    public function lucky(User $user)
    {
        $gameService = new GameService($user);
        $result = $gameService->run();

        return view('page-a', [
            'user' => $user,
            'result' => $result,
        ]);
    }

    public function history(User $user)
    {
        $history = $user->gameResults()->latest()->take(3)->get();

        return view('history', compact('history', 'user'));
    }
}
