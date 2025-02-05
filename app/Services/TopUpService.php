<?php
namespace App\Services;

use App\Models\TopUp;
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
        $sucessMessage = 'Success';
        $failedMessage = 'Failed';
        $inputBody['price'] = (int) $inputBody['price'];
        $percentage = rand(0, 100);
        if ($currentTime >= '09:00:00' && $currentTime <= '17:00:00') {
            $successRate = 90;
            if ($percentage < $successRate) {
                $topUpResult = $this->updateUserBalance($userId, $inputBody);
                return $this->returnFormat($topUpResult, $sucessMessage);
            } else {
                $topUpResult = $this->createHistoryTopUp($userId, $inputBody);
                return $this->returnFormat($topUpResult, $failedMessage);
            }
        } else {
            $successRate = 40;
            if ($percentage < $successRate) {
                $topUpResult = $this->updateUserBalance($userId, $inputBody);
                return $this->returnFormat($topUpResult, $sucessMessage);
            } else {
                $topUpResult = $this->createHistoryTopUp($userId, $inputBody);
                return $this->returnFormat($topUpResult, $failedMessage);
            }
        }
    }
    private function updateUserBalance(int $userId, $inputBody)
    {
        try {
            $userUpdateBalance = $this->createHistoryTopUp($userId, $inputBody);
            $this->userService->updateUser($userId,
                [
                    'phone_number' => $inputBody['phone_number'],
                    'balance' => $inputBody['price'],
                ]);
            return $userUpdateBalance;
        } catch (Exception $error) {
            throw $error;
        }
    }
    private function createHistoryTopUp(int $userId, $body)
    {
        try {
            return TopUp::create([
                'users_id' => $userId,
                'phone_number' => $body['phone_number'],
                'value' => $body['price'],
            ]);
        } catch (Exception $error) {
            return $error;
        }
    }

    private function returnFormat($queryData, $message)
    {
        return ['data' => $queryData, 'message' => $message];
    }
}
