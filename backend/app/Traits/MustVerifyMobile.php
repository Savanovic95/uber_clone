<?php

namespace App\Traits;

use App\Notifications\LoginNeedsVerification;

trait MustVerifyMobile
{
    public function hasVerifiedMobile(): bool
    {
        return ! is_null($this->mobile_verified_at);
    }

    public function markMobileAsVerified(): bool
    {
        return $this->forceFill([
            'login_code' => NULL,
            'updated_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendMobileVerificationNotification(bool $newData = false): void
    {
        if($newData)
        {
            $this->forceFill([
                'login_code' => random_int(111111, 999999),
            ])->save();
        }
        $this->notify(new LoginNeedsVerification);
    }
}
