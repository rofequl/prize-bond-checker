<?php

namespace App\Support;

use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Schema;
use Throwable;

class MailConfigurator
{
    public static function apply(): void
    {
        try {
            if (! Schema::hasTable('smtp_settings')) {
                return;
            }

            $setting = SmtpSetting::current();

            if ($setting === null || ! $setting->isConfigured()) {
                return;
            }

            $scheme = match ($setting->encryption) {
                'ssl' => 'smtps',
                default => null,
            };

            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => $setting->host,
                'mail.mailers.smtp.port' => $setting->port,
                'mail.mailers.smtp.username' => $setting->username,
                'mail.mailers.smtp.password' => $setting->password,
                'mail.mailers.smtp.encryption' => $setting->encryption ?: null,
                'mail.mailers.smtp.scheme' => $scheme,
                'mail.from.address' => $setting->from_address,
                'mail.from.name' => $setting->from_name ?: config('app.name'),
            ]);
        } catch (Throwable) {
            // Silent: keep default mail transport if anything goes wrong.
        }
    }
}
