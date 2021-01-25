<?php
namespace App\Services;

use App\Services\UsersService;
use Carbon\Carbon;
use Exception;

class TopUpService
{
    protected $userService;
    public function __construct(UsersService $usersService)
    {
        $this->userService = $usersService;
    }

    public function topUpBalance($inputBody, int $userId)
    {
        $currentTime = Carbon::now()->toTimeString();
        $errorChanceMessage = 'Top Up anda gagal';
        $inputBody['balance'] = (int) $inputBody['balance'];
        $percentage = rand(0, 100);
        if ($currentTime >= '09:00:00' && $currentTime <= '17:00:00') {
            $successRate = 90;
            if ($percentage < $successRate) {
                $updateBalance = $this->updateUserBalance($userId, $inputBody);
                return $updateBalance;
            } else {
                return $errorChanceMessage;
            }
        } else {
            $successRate = 40;
            if ($percentage < $successRate) {
                $updateBalance = $this->updateUserBalance($userId, $inputBody);
                return $updateBalance;
            } else {
                return $errorChanceMessage;
            }
        }
    }
    private function updateUserBalance(int $userId, $inputBody)
    {
        try {
            $userUpdateBalance = $this->userService->updateUser($userId,
                [
                    'phone_number' => $inputBody['phone_number'],
                    'balance' => $inputBody['balance'],
                ]);
            return $userUpdateBalance;
        } catch (Exception $error) {
            throw $error->getMessage();
        }
    }
}
