<?php

namespace App\Services;

use App\Models\PasswordHistory;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PasswordSecurityService
{
    protected int $maxHistory = 5;
    protected int $maxAttempts = 3;
    protected int $passwordExpiryMonths = 6;

    public function recordPasswordChange(Users $user, string $plainPassword): void
    {
        $user->password = Hash::make($plainPassword);
        $user->password_changed_at = Carbon::now();
        $user->failed_login_attempts = 0;
        $user->lockout_until = null;
        $user->save();

        PasswordHistory::create([
            'user_id' => $user->id,
            'password_hash' => $user->password,
        ]);

        $this->trimHistory($user);
    }

    public function isPasswordExpired(?Users $user): bool
    {
        if (!$user || !$user->password_changed_at) {
            return false;
        }

        return Carbon::parse($user->password_changed_at)->addMonths($this->passwordExpiryMonths)->isPast();
    }

    public function hasBeenUsedBefore(Users $user, string $plainPassword): bool
    {
        $history = $user->passwordHistories()->latest()->take($this->maxHistory)->get();
        foreach ($history as $item) {
            if (Hash::check($plainPassword, $item->password_hash)) {
                return true;
            }
        }
        return false;
    }

    public function registerFailedAttempt(Users $user): void
    {
        $user->failed_login_attempts = ($user->failed_login_attempts ?? 0) + 1;
        if ($user->failed_login_attempts >= $this->maxAttempts) {
            $user->lockout_until = Carbon::now()->addMinutes(15);
        }
        $user->save();
    }

    public function resetFailedAttempts(Users $user): void
    {
        $user->failed_login_attempts = 0;
        $user->lockout_until = null;
        $user->save();
    }

    protected function trimHistory(Users $user): void
    {
        $excess = $user->passwordHistories()->latest()->skip($this->maxHistory)->get();
        foreach ($excess as $item) {
            $item->delete();
        }
    }
}
