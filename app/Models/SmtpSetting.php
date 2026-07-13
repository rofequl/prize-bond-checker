<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmtpSetting extends Model
{
    protected $fillable = [
        'host',
        'port',
        'encryption',
        'username',
        'password',
        'from_address',
        'from_name',
        'enabled',
    ];

    protected function casts(): array
    {
        return [
            'port' => 'integer',
            'password' => 'encrypted',
            'enabled' => 'boolean',
        ];
    }

    public static function current(): ?self
    {
        return static::query()->orderBy('id')->first();
    }

    public function isConfigured(): bool
    {
        return $this->enabled
            && filled($this->host)
            && filled($this->port)
            && filled($this->from_address);
    }

    public static function isActive(): bool
    {
        $setting = static::current();

        return $setting !== null && $setting->isConfigured();
    }
}
