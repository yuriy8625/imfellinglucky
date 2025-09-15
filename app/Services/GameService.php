<?php

namespace App\Services;

use App\Models\GameResult;
use App\Models\User;

class GameService
{
    const MIN_NUMBER = 1;
    const MAX_NUMBER = 1000;

    const LOSE = 'Lose';
    const WIN = 'Win';

    protected int $number = 0;
    protected int $amount = 0;

    protected string $status = self::LOSE;

    public function __construct(protected User $user)
    {
        $this->setRandNumber();
        $this->setStatus();
    }

    protected function setStatus(): void
    {
        $this->status = $this->number && $this->number % 2 === 0 ? self::WIN : self::LOSE;
    }

    protected function setRandNumber(): void
    {
        $this->number = rand(self::MIN_NUMBER, self::MAX_NUMBER);
    }

    public function run(): GameResult
    {
        if ($this->status === self::WIN) {
            $this->amount = $this->calculateAmountByNumber();
        }

        return $this->createGameResult();
    }

    protected function calculateAmountByNumber(): int
    {
        return match (true) {
            $this->number > 900 => intval($this->number * 0.7),
            $this->number > 600 => intval($this->number * 0.5),
            $this->number > 300 => intval($this->number * 0.3),
            default       => intval($this->number * 0.1),
        };
    }

    public function createGameResult(): GameResult
    {
        $gameResult = new GameResult([
            'user_id' => $this->user->id,
            'number'  => $this->number,
            'status'  => $this->status,
            'amount'  => $this->amount,
        ]);
        $gameResult->save();

        return $gameResult;
    }
}
